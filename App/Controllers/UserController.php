<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->requireAdmin();
    }


    public function users()
    {
        $users = $this->userRepo->getAll();
        $this->view('admin/View_Users', ['users' => $users]);
    }


    public function create()
    {
        $this->view('admin/Add_Users');
    }


    public function store()
    {
        $name     = trim($_POST['name']        ?? '');
        $email    = trim($_POST['email']       ?? '');
        $phone    = trim($_POST['phone']       ?? '');
        $password = trim($_POST['password']    ?? '');
        $role     = trim($_POST['role']        ?? 'user');

        if (empty($name) || empty($email) || empty($password)) {
            Session::set('error', 'Please fill all required fields.');
            redirect('user/create');
        }

        $result = $this->userRepo->add_user($name, $email, $password, $role);

        if ($result) {
            Session::set('success', 'User added successfully.');
            redirect('user/users');
        } else {
            Session::set('error', 'Email already exists or something went wrong.');
            redirect('user/create');
        }
    }


    public function edit(int $id)
    {
        $user = $this->userRepo->getById($id);

        if (!$user) {
            Session::set('error', 'User not found.');
            redirect('user/users');
        }

        $this->view('admin/update-user', ['user' => $user]);
    }


    public function update()
    {
        $id    = (int) ($_POST['id']   ?? 0);
        $name  = trim($_POST['name']   ?? '');
        $email = trim($_POST['email']  ?? '');
        $phone = trim($_POST['phone']  ?? '');
        $role  = trim($_POST['role']   ?? 'user');

        $sql    = "UPDATE users SET name=?, email=?, phone=?, role=?, updated_at=NOW() WHERE id=?";

        $this->userRepo->query($sql, [$name, $email, $phone, $role, $id]);

        Session::set('success', 'User updated successfully.');
        redirect('user/users');
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $this->userRepo->query($sql, [$id]);

        Session::set('success', 'User deleted successfully.');
        redirect('user/users');
    }

    public function messages()
    {

        redirect('contact/messages');
    }

    // ── Helper ──────────────────────────────────────────────────────────

    private function requireAdmin(): void
    {
        if (!Session::check('user') || Session::get('user')['role'] === 'user') {
            redirect('home');
        }
    }
}
