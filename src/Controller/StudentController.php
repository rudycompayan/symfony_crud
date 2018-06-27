<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    /**
     * @Route("/students", name="students")
     */
    public function students()
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render('student/index.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/students/add", name="add_student")
     */
    public function add()
    {
        return $this->render('student/add.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/students/edit/{id}", name="edit_student")
     */
    public function edit($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        return $this->render('student/edit.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/students/save", name="save_student")
     */
    public function save(Request $request)
    {
        $student = new Student();
        $student->setName($request->get('name'));
        $student->setBday(new \DateTime($request->get('bday')));
        $student->setPhone($request->get('phone'));
        $student->setBlock($request->get('block'));
        $student->setCourse($request->get('course'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($student);
        $entityManager->flush();
        $this->addFlash("success", "Student was successfully added.");

        return $this->redirect('/students');
    }

    /**
     * @Route("/students/update", name="update_student")
     */
    public function update(Request $request)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($request->get('id'));
        $student->setName($request->get('name'));
        $student->setBday(new \DateTime($request->get('bday')));
        $student->setPhone($request->get('phone'));
        $student->setBlock($request->get('block'));
        $student->setCourse($request->get('course'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash("success", "Student was successfully updated.");

        return $this->redirect('/students/edit/'.$request->get('id'));
    }

    /**
     * @Route("/students/delete/{id}", name="delete_student")
     */
    public function delete($id)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($student);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}
