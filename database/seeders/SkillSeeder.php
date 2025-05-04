<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::insert([
            [
                'name' => 'COMUNICACIÓN E INFLUENCIA',
                'description' => 'Es la capacidad para entregar un mensaje con una intención clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas persuadiendo al interlocutor o para lograr un objetivo particular.',
            ],
            [
                'name' => 'ORIENTACIÓN A RESULTADOS',
                'description' => 'Es la capacidad para establecer objetivos, direccionando recursos y optimizando procesos para llevarlos a su consecución.',
            ],
            [
                'name' => 'TRABAJO EN EQUIPO',
                'description' => 'Es la capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
            ],
            [
                'name' => 'RESOLUCIÓN DE PROBLEMAS',
                'description' => 'Es la capacidad para detectar problemas u oportunidades, analizando información e iniciando acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos.',
            ],
            [
                'name' => 'DISPOSICIÓN AL SERVICIO Y CLIENTE',
                'description' => 'Es la capacidad para dirigir acciones hacia el mantenimiento de las relaciones positivas con los clientes.',
            ],
            [
                'name' => 'AUTOGESTIÓN',
                'description' => 'Es la capacidad para determinar las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
            ],
            [
                'name' => 'INTUICIÓN COMERCIAL',
                'description' => 'Es la capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial.',
            ],
            [
                'name' => 'COLABORACIÓN',
                'description' => 'Es la capacidad para trabajar con otras personas compartiendo ideas, recursos y responsabilidades para alcanzar objetivos comunes de forma coordinada.',
            ],
            [
                'name' => 'EMPATÍA CON EL CLIENTE',
                'description' => 'Es la capacidad de comprender profundamente las necesidades, sentimientos y perspectivas de los clientes creando una conexión genuina que permita ofrecer soluciones personalizadas y relevantes.',
            ],
            [
                'name' => 'TOMA DE DECISIONES',
                'description' => 'Capacidad para analizar información descomponiéndola en partes y procesándola desde diferentes ángulos, considerando datos, argumentos y consecuencias para tomar decisiones fundamentadas.',
            ],
            [
                'name' => 'NEGOCIACIÓN',
                'description' => 'Capacidad para alcanzar acuerdos que beneficien a ambas partes, gestionando diferencias de manera comunicativa y persuasiva.',
            ],
            [
                'name' => 'SENTIDO DE URGENCIA',
                'description' => 'Capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
            ],
            [
                'name' => 'ASERTIVIDAD',
                'description' => 'Capacidad para expresar opiniones, necesidades y límites de manera clara, directa y respetuosa, equilibrando firmeza y empatía en la interacción con otros.',
            ],
            [
                'name' => 'PENSAMIENTO TÁCTICO',
                'description' => 'Capacidad para convertir las metas estratégicas de la organización en planes y acciones concretos dentro de su área de responsabilidad, asegurando que el equipo se encuentre alineado con los objetivos organizacionales.',
            ],
            [
                'name' => 'LIDERAZGO COMUNICACIONAL',
                'description' => 'Capacidad para mantener una comunicación fluida y clara con su equipo y colegas, asegurando la alineación de las metas y la eficiencia en la ejecución de tareas diarias.',
            ],
            [
                'name' => 'COLABORACIÓN Y RELACIONAMIENTO',
                'description' => 'Capacidad para trabajar en equipo de manera eficaz, asegurando la cooperación entre colegas y otros departamentos para alcanzar metas comunes.',
            ],
            [
                'name' => 'DESARROLLO DE TALENTO',
                'description' => 'Capacidad para identificar las fortalezas y áreas de mejora en su equipo, creando oportunidades de crecimiento y aprendizaje para cada miembro.',
            ],
            [
                'name' => 'MANEJO DE CONFLICTOS',
                'description' => 'Capacidad de abordar y resolver desacuerdos de manera constructiva, manteniendo relaciones saludables, fortaleciendo la confianza y asegurando resultados positivos para las partes involucradas.',
            ],
            [
                'name' => 'GESTIÓN DE RECURSOS',
                'description' => 'Capacidad para administrar de manera eficiente los recursos disponibles (humanos, financieros, tecnológicos y materiales) con el fin de alcanzar los resultados esperados. ',
            ],
        ]);
    }
}
