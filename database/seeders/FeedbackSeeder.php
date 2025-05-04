<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\Feedback;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedback::truncate();

        //LEVEL 1
        $level = 1;
        $skill_id = Skill::where('name', 'COMUNICACIÓN E INFLUENCIA')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'ORIENTACIÓN A RESULTADOS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'TRABAJO EN EQUIPO')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'RESOLUCIÓN DE PROBLEMAS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'DISPOSICIÓN AL SERVICIO Y CLIENTE')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'AUTOGESTIÓN')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'INTUICIÓN COMERCIAL')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'COLABORACIÓN')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para trabajar con otras personas compartiendo ideas, recursos y responsabilidades para alcanzar objetivos comunes de forma coordinada.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para trabajar con otras personas compartiendo ideas, recursos y responsabilidades para alcanzar objetivos comunes de forma coordinada.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para trabajar con otras personas compartiendo ideas, recursos y responsabilidades para alcanzar objetivos comunes de forma coordinada.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'NEGOCIACIÓN')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para alcanzar acuerdos que beneficien a ambas partes, no logrando gestionar diferencias de manera comunicativa o persuasiva.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para alcanzar acuerdos que beneficien a ambas partes, gestionando diferencias de manera comunicativa y persuasiva.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para alcanzar acuerdos que beneficien a ambas partes, gestionando diferencias de manera comunicativa y persuasiva.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'SENTIDO DE URGENCIA')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'ASERTIVIDAD')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para expresar opiniones, necesidades y límites de manera clara, directa y respetuosa, equilibrando firmeza y empatía en la interacción con otros.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para expresar opiniones, necesidades y límites de manera clara, directa y respetuosa, equilibrando firmeza y empatía en la interacción con otros.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para expresar opiniones, necesidades y límites de manera clara, directa y respetuosa, equilibrando firmeza y empatía en la interacción con otros.',
                'level' => $level,
            ],
        ]);

        //LEVEL 2
        $level = 2;
        $skill_id = Skill::where('name', 'COMUNICACIÓN E INFLUENCIA')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'ORIENTACIÓN A RESULTADOS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'TRABAJO EN EQUIPO')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'RESOLUCIÓN DE PROBLEMAS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'DISPOSICIÓN AL SERVICIO Y CLIENTE')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'AUTOGESTIÓN')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'INTUICIÓN COMERCIAL')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'SENTIDO DE URGENCIA')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Demuestra baja capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Demuestra mediana capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Demuestra alta capacidad para actuar con rapidez y eficiencia en situaciones críticas, priorizando tareas para cumplir con plazos y expectativas de los clientes.',
                'level' => $level,
            ],
        ]);

        //LEVEL 3
        $level = 3;
        $skill_id = Skill::where('name', 'PENSAMIENTO TÁCTICO')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para convertir las metas estratégicas de la organización en planes y acciones concretos dentro de su área de responsabilidad, asegurando que el equipo se encuentre alineado con los objetivos organizacionales.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para convertir las metas estratégicas de la organización en planes y acciones concretos dentro de su área de responsabilidad, asegurando que el equipo se encuentre alineado con los objetivos organizacionales.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para convertir las metas estratégicas de la organización en planes y acciones concretos dentro de su área de responsabilidad, asegurando que el equipo se encuentre alineado con los objetivos organizacionales.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'LIDERAZGO COMUNICACIONAL')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para mantener una comunicación fluida y clara con su equipo y colegas, no logrando asegurar la alineación de las metas y la eficiencia en la ejecución de tareas diarias.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para mantener una comunicación fluida y clara con su equipo y colegas, no logrando una completa alineación de las metas y la eficiencia en la ejecución de tareas diarias.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta una alta capacidad para mantener una comunicación fluida y clara con su equipo y colegas, asegurando la alineación de las metas y la eficiencia en la ejecución de tareas diarias.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'COLABORACIÓN Y RELACIONAMIENTO')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para trabajar en equipo de manera eficaz, no logrando asegurar la cooperación entre colegas y otros departamentos para alcanzar metas comunes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para trabajar en equipo de manera eficaz, asegurando de forma promedio la cooperación entre colegas y otros departamentos para alcanzar metas comunes.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para trabajar en equipo de manera eficaz, asegurando la cooperación entre colegas y otros departamentos para alcanzar metas comunes.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'DESARROLLO DE TALENTO')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para identificar las fortalezas y áreas de mejora en su equipo, no pudiendo crear oportunidades de crecimiento y aprendizaje para cada miembro.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para identificar las fortalezas y áreas de mejora en su equipo, creando oportunidades de crecimiento y aprendizaje para cada miembro a nivel promedio.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para identificar las fortalezas y áreas de mejora en su equipo, creando oportunidades de crecimiento y aprendizaje para cada miembro.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'MANEJO DE CONFLICTOS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para abordar y resolver desacuerdos de manera constructiva, manteniendo relaciones saludables, fortaleciendo la confianza y asegurando resultados positivos para las partes involucradas.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para abordar y resolver desacuerdos de manera constructiva, manteniendo relaciones saludables, fortaleciendo la confianza y asegurando resultados positivos para las partes involucradas.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para abordar y resolver desacuerdos de manera constructiva, manteniendo relaciones saludables, fortaleciendo la confianza y asegurando resultados positivos para las partes involucradas.',
                'level' => $level,
            ],
        ]);
        $skill_id = Skill::where('name', 'GESTIÓN DE RECURSOS')->first()->id;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'Presenta baja capacidad para administrar de manera eficiente los recursos disponibles (humanos, financieros, tecnológicos y materiales) con el fin de alcanzar los resultados esperados.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'Presenta mediana capacidad para administrar de manera eficiente los recursos disponibles (humanos, financieros, tecnológicos y materiales) con el fin de alcanzar los resultados esperados.',
                'level' => $level,
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'Presenta alta capacidad para administrar de manera eficiente los recursos disponibles (humanos, financieros, tecnológicos y materiales) con el fin de alcanzar los resultados esperados.',
                'level' => $level,
            ],
        ]);

        //General feedback without skills ID
        $skill_id = null;
        Feedback::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'content' => 'El candidato demuestra un resultado global bajo como promedio total de las diferentes habilidades evaluadas. Lo anterior indica un amplio margen de mejora para cumplir con los requisitos del puesto o el rol de manera efectiva por las dificultades significativas que presenta.',
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'content' => 'El candidato demuestra un resultado global medio como promedio total de las diferentes habilidades evaluadas. Lo anterior, le puede permitir cumplir con las expectativas mínimas requeridas del puesto o el rol, aunque con un margen de mejora y, en consecuencia, espacio para desarrollos adicionales para alcanzar un nivel superior.',
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'content' => 'El candidato demuestra un resultado global alto como promedio total de las diferentes habilidades evaluadas. Lo anterior, puede llevarlo a desempeñarse de manera efectiva en el puesto o rol y aportar un valor significativo a la organización.',
            ],
        ]);
    }
}
