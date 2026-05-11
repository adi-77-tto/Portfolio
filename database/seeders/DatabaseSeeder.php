<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'adittosaha77@gmail.com',
        ], [
            'name' => 'Aditto Saha',
            'password' => Hash::make('admin12345'),
        ]);

        Project::query()->delete();
        Skill::query()->delete();
        Achievement::query()->delete();

        Project::query()->insert([
            [
                'title' => 'Employee Management System',
                'description' => 'Employee Management System provides a GUI to add, view, update, and manage employee records efficiently. It keeps HR and admin data organized for faster daily operations.',
                'tech_stack' => 'Java, Java Swing',
                'github_url' => 'https://github.com/adi-77-tto/Employee-Management-System',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fun With Set Mania',
                'description' => 'A Java learning project for set theory practice including union, intersection, difference, complement, subsets, Cartesian product, and power set through interactive programs.',
                'tech_stack' => 'Java',
                'github_url' => 'https://github.com/adi-77-tto/Set-Mania',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Crypto Vault',
                'description' => 'Java desktop app for secure login and file encryption/decryption using a 16-character AES key with SHA-512 password hashing and organized storage output.',
                'tech_stack' => 'Java, Java Swing',
                'github_url' => 'https://github.com/adi-77-tto/CRyPto-VaULt',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hash Generator',
                'description' => 'Java-based tool that converts input into SHA-512 hash values, useful for demonstrating one-way encryption and secure verification workflows.',
                'tech_stack' => 'Java, Java Swing',
                'github_url' => 'https://github.com/adi-77-tto/Secure-Hash-Algorithm-512',
                'live_url' => null,
                'image' => null,
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Evermore',
                'description' => 'Full-stack ecommerce project for browsing products, cart and checkout, user authentication, custom design tools, and admin management with MySQL.',
                'tech_stack' => 'React, PHP, MySQL',
                'github_url' => 'https://github.com/adi-77-tto/evermore',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'RSDA',
                'description' => 'Web-based NGO management system to organize users, roles, records, and day-to-day administration workflows in one platform.',
                'tech_stack' => 'Laravel, PHP Backend',
                'github_url' => 'https://github.com/adi-77-tto/RSDA',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DocuGrad',
                'description' => 'Laravel full-stack project with structured backend and modern frontend tooling, focused on academic and document workflows with secure data handling.',
                'tech_stack' => 'Laravel',
                'github_url' => 'https://github.com/adi-77-tto/DocuGrad',
                'live_url' => null,
                'image' => null,
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Skill::query()->insert([
            ['name' => 'PHP', 'category' => 'language', 'level' => 'advanced', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'JS', 'category' => 'language', 'level' => 'advanced', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laravel', 'category' => 'framework', 'level' => 'advanced', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SpringBoot', 'category' => 'framework', 'level' => 'intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Flutter', 'category' => 'framework', 'level' => 'intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'category' => 'framework', 'level' => 'intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Git', 'category' => 'tool', 'level' => 'advanced', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Figma', 'category' => 'tool', 'level' => 'intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'N8n', 'category' => 'tool', 'level' => 'intermediate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MySQL', 'category' => 'db', 'level' => 'advanced', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Achievement::query()->insert([
            [
                'title' => 'EDGE Program Certificate',
                'description' => 'Successfully completed EDGE program certification.',
                'date' => now()->subYear()->toDateString(),
                'type' => 'Certificate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Academic Progress',
                'description' => '4th year BSE in Software Engineering, CGPA 3.59 at Noakhalli Science and Technology University.',
                'date' => now()->toDateString(),
                'type' => 'Education',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
