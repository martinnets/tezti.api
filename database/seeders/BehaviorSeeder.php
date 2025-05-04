<?php

namespace Database\Seeders;

use App\Models\Behavior;
use App\Models\Skill;
use App\Models\SkillBehavior;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BehaviorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //PRIMER LOTE DE COMPORTAMIENTOS
        $skill_id = Skill::where('name', 'COMUNICACIÓN E INFLUENCIA')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/1/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Orienta a los clientes hacia toma de decisiones que satisfagan sus necesidades.',
                    'scorm' => '/scorms/2/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Explicar soluciones o procesos de manera clara para así evitar confusiones o malentendidos.',
                    'scorm' => '/scorms/3/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Influye en la decisión del cliente a través de la adaptación de su comunicación dependiendo del interlocutor y el contexto',
                    'scorm' => '/scorms/4/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Escucha atentamente y comprende completamente las consultas o preocupaciones de los clientes.',
                    'scorm' => '/scorms/5/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/6/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Recapitula las discusiones y acuerda los próximos pasos.',
                    'scorm' => '/scorms/7/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Organiza ideas priorizando mensajes y enfatizando ideas clave para transmitir su punto de vista de forma concisa.',
                    'scorm' => '/scorms/8/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca conexión y empatizar con los clientes, entendiendo su necesidad desde la comprensión de su circunstancia individual',
                    'scorm' => '/scorms/9/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Formula repreguntas para asegurarse de haber comprendido el mensaje.',
                    'scorm' => '/scorms/10/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'ORIENTACIÓN A RESULTADOS')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/11/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se adapta a situaciones inesperadas manteniendo el foco en sus objetivos y cumpliendo los protocolos.',
                    'scorm' => '/scorms/12/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Conoce los lineamientos y normas básicos de la organización para lograr los objetivos.',
                    'scorm' => '/scorms/13/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Mantiene la concentración y el enfoque en las tareas que realiza.',
                    'scorm' => '/scorms/14/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Capacidad para completar tareas que den cierre a los requerimientos que asume.',
                    'scorm' => '/scorms/15/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/16/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se traza metas y objetivos que debe cumplir, en forma clara y concreta.',
                    'scorm' => '/scorms/17/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca maneras alternativas de conducir sus acciones para obtener los mismos resultados.',
                    'scorm' => '/scorms/18/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Planifica acciones y organiza recursos para alcanzar sus objetivos.',
                    'scorm' => '/scorms/19/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Persiste para alcanzar los objetivos a pesar de los obstáculos y contratiempos.',
                    'scorm' => '/scorms/20/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'TRABAJO EN EQUIPO')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/21/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Muestra predisposición a colaborar de manera activa y voluntaria con su entorno cercano.',
                    'scorm' => '/scorms/22/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Prioriza los objetivos del equipo sobre los individuales para garantizar el resultado común.',
                    'scorm' => '/scorms/23/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Asume sus propias responsabilidades, de forma dedicada, para cumplir con los compromisos colectivos.',
                    'scorm' => '/scorms/24/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Sabe pedir ayuda para lograr que las cosas sucedan.',
                    'scorm' => '/scorms/25/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/26/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Propone actvidades y soluciones para mantener la integración del equipo.',
                    'scorm' => '/scorms/27/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => ' Se involucra en el objetivo en común, facilitando el trabajo del equipo.',
                    'scorm' => '/scorms/28/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Escucha e incorpora las ideas y experiencia de los demás.',
                    'scorm' => '/scorms/29/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Promueve la colaboración involucrando a sus colegas.',
                    'scorm' => '/scorms/30/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'RESOLUCIÓN DE PROBLEMAS')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/31/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica problemas u oportunidades en situaciones que se le presentan.',
                    'scorm' => '/scorms/32/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca recopilar información y organizar lo relevante para encontrar alternativas de solución.',
                    'scorm' => '/scorms/33/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evalúa alternativas para llegar a la mejor solución.',
                    'scorm' => '/scorms/34/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca la ayuda y los recursos necesarios para resolver los problemas de manera inmediata.',
                    'scorm' => '/scorms/35/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/36/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Toma decisiones efectivas, dando soluciones que generan valor en el corto plazo.',
                    'scorm' => '/scorms/37/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se anticipa a las problemáticas e identifica posibles contingencias.',
                    'scorm' => '/scorms/38/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica las causas de un problema para comprender por qué se produce.',
                    'scorm' => '/scorms/39/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica y evalúa alternativas de múltiples soluciones y sus consecuencias.',
                    'scorm' => '/scorms/40/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'DISPOSICIÓN AL SERVICIO Y CLIENTE')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/41/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Muestra actitud de servicio a través de una disposición cálida hacia el cliente.',
                    'scorm' => '/scorms/42/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca comprender las circunstancias, problemas, expectativas y necesidades de los clientes.',
                    'scorm' => '/scorms/43/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Posee la capacidad de responder frente a problemas de clientes, más aún si se encuentran atravesando periodos críticos, de insatisfacción y/o molestia.',
                    'scorm' => '/scorms/44/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Agota recursos para que el cliente se sienta satisfecho, independientemente de la naturaleza de su necesidad.',
                    'scorm' => '/scorms/45/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/46/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Realiza seguimiento a las soluciones brindadas a los clientes para evitar problemas recurrentes.',
                    'scorm' => '/scorms/47/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca los medios para satisfacer las necesidades de los clientes en los tiempos requeridos.',
                    'scorm' => '/scorms/48/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Proactivamente aborda las potenciales necesidades de los clientes, anticipándose a las mismas.',
                    'scorm' => '/scorms/49/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Considera cómo sus acciones afectarán a sus clientes al momento de responder para satisfacer sus necesidades.',
                    'scorm' => '/scorms/50/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'AUTOGESTIÓN')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/51/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Aprovecha los recursos disponibles inmediatos (individuos, procesos y herramientas) para completar el trabajo de manera eficiente.',
                    'scorm' => '/scorms/52/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica el orden correcto de sus actividades para lograr completarlas a cabalidad.',
                    'scorm' => '/scorms/53/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evita problemas irrelevantes o distracciones que puedan interferir con la finalización del trabajo.',
                    'scorm' => '/scorms/54/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica actividades y tareas más y menos críticas.',
                    'scorm' => '/scorms/55/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/56/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Establece prioridades en base a los resultados que necesita alcanzar.',
                    'scorm' => '/scorms/57/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Desarrolla cronogramas e hitos para las actividades asignadas.',
                    'scorm' => '/scorms/58/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Distribuye el tiempo de forma eficiente buscando completar sus tareas.',
                    'scorm' => '/scorms/59/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Aprovecha todos los recursos a su disposición (individuos, procesos, herramientas, departamentos) para completar su trabajo de manera eficiente.',
                    'scorm' => '/scorms/60/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'INTUICIÓN COMERCIAL')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/61/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Ofrece alternativas de solución, bajo el marco del proceso comercial, para cubrir la necesidad comercial del cliente.',
                    'scorm' => '/scorms/62/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Formula preguntas para comprender las necesidades comerciales del cliente.',
                    'scorm' => '/scorms/63/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Aclara las objeciones para comprender la causa raíz de la necesidad comercial del cliente.',
                    'scorm' => '/scorms/64/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Aprovecha las características, ventajas y beneficios de productos o servicios para coincidirlos con el perfil del cliente y brindarle soluciones.',
                    'scorm' => '/scorms/65/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/66/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Aprovecha las características, ventajas y beneficios de productos y servicios para la creación de soluciones que satisfagan al cliente.',
                    'scorm' => '/scorms/67/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se anticipa a las inquietudes comerciales del cliente.',
                    'scorm' => '/scorms/68/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evalúa las ventajas y desventajas de cada opción que ofrece como solución.',
                    'scorm' => '/scorms/69/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca comprender necesidades adicionales o desafíos futuros que el cliente podría enfrentar para ofrecer soluciones que cubran esta necesidad.',
                    'scorm' => '/scorms/70/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        //SEGUNDO LOTE DE COMPORTAMIENTOS
        $skill_id = Skill::where('name', 'COLABORACIÓN')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/71/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Muestra predisposición a colaborar de manera activa y voluntaria con su entorno cercano.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Prioriza los objetivos del equipo sobre los individuales para garantizar el resultado común.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Sabe pedir ayuda para lograr que las cosas sucedan.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca los medios para satisfacer las necesidades de los clientes en los tiempos requeridos.',
                    'scorm' => '/scorms/48/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'EMPATÍA CON EL CLIENTE')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/72/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Proactivamente aborda las potenciales necesidades de los clientes, anticipándose a las mismas.',
                    'scorm' => '/scorms/49/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Realiza seguimiento a las soluciones brindadas a los clientes para evitar problemas recurrentes.',
                    'scorm' => '/scorms/47/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca comprender necesidades adicionales o desafíos futuros que el cliente podría enfrentar para ofrecer soluciones que cubran esta necesidad.',
                    'scorm' => '/scorms/70/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se anticipa a las inquietudes comerciales del cliente.',
                    'scorm' => '/scorms/68/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'TOMA DE DECISIONES')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/73/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Identifica las causas de un problema para comprender por qué se produce.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Toma decisiones efectivas, dando soluciones que generan valor en el corto plazo.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Identifica y evalúa alternativas de múltiples soluciones y sus consecuencias.')->first()->id
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::where('name', 'Evalúa las ventajas y desventajas de cada opción que ofrece como solución.')->first()->id
            ],
        ]);

        $skill_id = Skill::where('name', 'NEGOCIACIÓN')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/74/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Maneja reclamos proponiendo soluciones prácticas.',
                    'scorm' => '/scorms/75/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Adapta las propuestas para generar valor adicional en cada interacción.',
                    'scorm' => '/scorms/76/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Busca puntos de equilibrio al negociar tiempos de entrega, recursos o prioridades.',
                    'scorm' => '/scorms/68/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evalúa sus necesidades y limitaciones para formular propuestas viables y mutuamente beneficiosas.',
                    'scorm' => '/scorms/77/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'SENTIDO DE URGENCIA')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/78/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Resuelve solicitudes inmediatas sin comprometer la calidad del servicio.',
                    'scorm' => '/scorms/12/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Actúa para anticipar posibles problemas y evita retrasos en las entregas o atención al cliente.',
                    'scorm' => '/scorms/68/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Reorganiza su plan de trabajo según las prioridades cambiantes, asegurando que las tareas urgentes se completen a tiempo.',
                    'scorm' => '/scorms/59/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Notifica oportunamente cualquier situación que pueda comprometer la calidad del servicio o los plazos.',
                    'scorm' => '/scorms/79/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 2',
                    'scorm' => '/scorms/80/',
                    'level' => 2,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica tareas prioritarias y reorganiza su agenda para cumplir con plazos ajustados.',
                    'scorm' => '/scorms/57/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se asegura de completar entregas urgentes sin sacrificar la precisión de los datos o documentos.',
                    'scorm' => '/scorms/81/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Se anticipa a solicitudes inesperadas, informando cualquier limitación o recurso necesario.',
                    'scorm' => '/scorms/68/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Mantiene el enfoque en las tareas críticas mientras gestiona interrupciones con eficacia.',
                    'scorm' => '/scorms/54/',
                    'level' => 2,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'ASERTIVIDAD')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Inicio - Nivel 1',
                    'scorm' => '/scorms/82/',
                    'level' => 1,
                    'is_question' => false,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Comunica desacuerdos a un cliente de forma profesional, sin caer en pasividad ni agresividad.',
                    'scorm' => '/scorms/83/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Comunica al cliente los límites del servicio de manera respetuosa pero firme, ofreciendo alternativas viables.',
                    'scorm' => '/scorms/84/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Responde a comentarios o críticas del cliente con empatía y sin reacciones defensivas.',
                    'scorm' => '/scorms/85/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Maneja solicitudes adicionales o cambios inesperados, estableciendo límites razonables y prioridades claras.',
                    'scorm' => '/scorms/13/',
                    'level' => 1,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        //TERCER LOTE DE COMPORTAMIENTOS
        $skill_id = Skill::where('name', 'PENSAMIENTO TÁCTICO')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Asegura que las metas y acciones de su equipo estén directamente relacionadas con las prioridades estratégicas de la organización.',
                    'scorm' => '/scorms/86/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Distribuye y utiliza los recursos humanos, financieros y materiales de manera óptima (prioriza), asegurando que se maximice el impacto hacia los objetivos estratégicos rápidamente.',
                    'scorm' => '/scorms/87/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Monitorea el progreso hacia los objetivos, realizando ajustes cuando sea necesario para mantener el equipo en línea con la estrategia organizacional.',
                    'scorm' => '/scorms/88/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evalúa diferentes escenarios y riesgos antes de tomar decisiones tácticas que afecten los resultados del equipo y el área, considerando siempre el impacto en la estrategia general.',
                    'scorm' => '/scorms/89/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'LIDERAZGO COMUNICACIONAL')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Articula una visión clara y convincente, conectando los objetivos organizacionales con el propósito del equipo, para inspirar y motivar a los colaboradores hacia la acción.',
                    'scorm' => '/scorms/90/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Practica la escucha activa y aborda las preocupaciones del personal, fomentando un ambiente de confianza y apertura.',
                    'scorm' => '/scorms/91/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Utiliza diferentes canales de comunicación según las necesidades y contextos de la situación, asegurando la efectividad del mensaje.',
                    'scorm' => '/scorms/92/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Adapta su estilo de comunicación a las características de su audiencia, asegurándose de que los mensajes sean comprendidos y generen el impacto deseado.',
                    'scorm' => '/scorms/93/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'COLABORACIÓN Y RELACIONAMIENTO')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Involucra a otros departamentos para resolver problemas operativos, fomentando un enfoque conjunto en la solución de desafíos.',
                    'scorm' => '/scorms/94/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Promueve la colaboración dentro de su área, asegurando que los esfuerzos colectivos se alineen con los objetivos del equipo y la organización.',
                    'scorm' => '/scorms/95/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Utiliza sus redes internas para acceder a recursos, conocimientos o información que puedan apoyar el logro de los objetivos del equipo.',
                    'scorm' => '/scorms/96/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Establece un entorno de trabajo en el que se valoran las aportaciones de todos los miembros del equipo, promoviendo la confianza y el intercambio de ideas.',
                    'scorm' => '/scorms/97/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'DESARROLLO DE TALENTO')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Reconoce y celebra los logros y contribuciones del equipo de manera específica y oportuna, fortaleciendo la motivación y el compromiso.',
                    'scorm' => '/scorms/98/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica a los colaboradores con alto potencial dentro de su equipo, brindándoles oportunidades de desarrollo y exposición para acelerar su crecimiento.',
                    'scorm' => '/scorms/99/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Delega tareas y proyectos de manera estratégica, asegurando que los colaboradores asuman retos que les permitan desarrollar nuevas habilidades, fortalecer su confianza y prepararse para roles más complejos en el futuro.',
                    'scorm' => '/scorms/100/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Provee retroalimentación clara y constructiva a su equipo, asegurando que cada miembro entienda cómo mejorar y contribuir a los objetivos del equipo.',
                    'scorm' => '/scorms/101/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'MANEJO DE CONFLICTOS')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Reconoce sus propias emociones y reacciones en situaciones de conflicto, gestionándolas de manera efectiva para evitar escaladas y garantizar un comportamiento calmado y profesional en todo momento.',
                    'scorm' => '/scorms/102/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Toma decisiones considerando no solo los hechos, sino también las implicaciones emocionales para las partes afectadas, priorizando soluciones que minimicen tensiones y promuevan relaciones positivas.',
                    'scorm' => '/scorms/103/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Reconoce patrones de conflicto recurrentes y trabaja para prevenirlos.',
                    'scorm' => '/scorms/104/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Evalúa las dinámicas de poder en un conflicto para garantizar que todas las partes tengan una participación justa.',
                    'scorm' => '/scorms/105/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::where('name', 'GESTIÓN DE RECURSOS')->first()->id;
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Asegura que todos los miembros del equipo comprenden claramente sus roles, responsabilidades y las expectativas, contribuyendo a una ejecución alineada.',
                    'scorm' => '/scorms/106/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Define prioridades claras para la asignación de recursos, alineadas con los objetivos estratégicos.',
                    'scorm' => '/scorms/107/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica eficiencias y oportunidades para optimizar el uso de los recursos disponibles.',
                    'scorm' => '/scorms/108/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Anticipa y gestiona limitaciones de recursos, asegurando la continuidad de los proyectos clave.',
                    'scorm' => '/scorms/109/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        //INTRO Y CIERRE DE EVALUACIÓN
        Behavior::insert([
            'name' => 'Intro',
            'scorm' => '/scorms/intro/',
            'level' => 0,
            'type' => 'intro',
            'is_question' => false,
            'is_active' => true
        ]);
        Behavior::insert([
            'name' => 'Cierre',
            'scorm' => '/scorms/closing/',
            'level' => 0,
            'type' => 'closing',
            'is_question' => false,
            'is_active' => true
        ]);

    }
}
