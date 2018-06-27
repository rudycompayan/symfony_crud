<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findBy([],['id' => 'DESC'], 3);
        $students_all = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('admin/index.html.twig', [
            'students' => $students,
            'students_all' => $students_all
        ]);
    }
}
