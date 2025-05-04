<?php

namespace Database\Seeders;

use App\Models\Behavior;
use App\Models\Skill;
use App\Models\SkillBehavior;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplementaryBehaviorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skill_id = Skill::insertGetId([
            'name' => 'GESTIÓN EFICIENTE DEL TIEMPO',
            'description' => 'Capacidad para coordinar, estructurar y potenciar el desempeño del equipo mediante una clara asignación de roles, una gestión efectiva de los recursos y la promoción de un ambiente de colaboración.',
            'is_active' => true,
            'created_at' => now(),
        ]);
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Garantiza que cada miembro del equipo tenga una comprensión clara del alcance de su rol y los resultados esperados, permitiendo una ejecución coordinada.',
                    'scorm' => '/scorms/106/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Establece criterios claros para distribuir los recursos de manera estratégica, asegurando que su uso responda a las prioridades organizacionales.',
                    'scorm' => '/scorms/107/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Ofrece retroalimentación oportuna y específica, ayudando a cada miembro a fortalecer sus habilidades y maximizar su contribución a los objetivos comunes.',
                    'scorm' => '/scorms/101/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Fomenta un entorno colaborativo dentro de su equipo, promoviendo la alineación de esfuerzos individuales y grupales con la estrategia organizacional.',
                    'scorm' => '/scorms/95/',
                    'level' => 3,
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
                    'name' => 'Analiza el escenario completo de distintas alternativas y su impacto antes de tomar decisiones, asegurando que estén alineadas con los objetivos organizacionales.',
                    'scorm' => '/scorms/89/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Prevé y administra restricciones de recursos, garantizando que los proyectos sigan avanzando sin interrupciones.',
                    'scorm' => '/scorms/109/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Identifica tendencias en los conflictos dentro del equipo y actúa de manera preventiva para reducir su recurrencia y minimizar su impacto.',
                    'scorm' => '/scorms/104/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Hace seguimiento continuo de los avances, planteando cambios necesarios para mantener la alineación con la estrategia organizacional.',
                    'scorm' => '/scorms/88/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::insertGetId([
            'name' => 'OPTIMIZACIÓN Y PRODUCTIVIDAD',
            'description' => 'Capacidad para identificar oportunidades de mejora en la gestión de recursos, procesos y tiempo, asegurando que los esfuerzos del equipo sean eficientes y generen el mayor impacto posible.',
            'is_active' => true,
            'created_at' => now(),
        ]);
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Detecta oportunidades para mejorar la eficiencia en el uso de los recursos disponibles, asegurando su aprovechamiento.',
                    'scorm' => '/scorms/108/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Recurre a su red de contactos dentro de la organización para obtener los recursos que lo lleven al cumplimiento de los objetivos.',
                    'scorm' => '/scorms/96/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Gestiona de manera estratégica los recursos humanos, financieros y materiales, garantizando un resultado inmediato.',
                    'scorm' => '/scorms/87/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Fomenta un entorno de reconocimiento a las todas contribuciones individuales, fortaleciendo las relaciones.',
                    'scorm' => '/scorms/97/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::insertGetId([
            'name' => 'RESOLUCIÓN DE PROBLEMAS ESTRATÉGICOS',
            'description' => 'Capacidad para analizar situaciones complejas, identificar riesgos y oportunidades, y tomar decisiones informadas y ágiles para garantizar la resolución de problemas dentro del equipo y la organización.',
            'is_active' => true,
            'created_at' => now(),
        ]);
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Analiza el escenario completo de distintas alternativas y su impacto antes de tomar decisiones, asegurando que estén alineadas con los objetivos organizacionales.',
                    'scorm' => '/scorms/89/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Detecta oportunidades para mejorar la eficiencia en el uso de los recursos disponibles, asegurando su aprovechamiento.',
                    'scorm' => '/scorms/108/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Considera tanto los datos objetivos como el impacto en las personas al momento de tomar decisiones, enfocándose en estrategias que disminuyan conflictos.',
                    'scorm' => '/scorms/103/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Prevé y administra restricciones de recursos, garantizando que los proyectos sigan avanzando sin interrupciones.',
                    'scorm' => '/scorms/109/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::insertGetId([
            'name' => 'INFLUENCIA',
            'description' => 'Capacidad para construir relaciones dentro de la organización, movilizar recursos e influir en otros para alcanzar los objetivos del equipo y la organización de manera eficiente.',
            'is_active' => true,
            'created_at' => now(),
        ]);
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Recurre a su red de contactos dentro de la organización para obtener los recursos que lo lleven al cumplimiento de los objetivos.',
                    'scorm' => '/scorms/96/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Detecta oportunidades para mejorar la eficiencia en el uso de los recursos disponibles, asegurando su aprovechamiento.',
                    'scorm' => '/scorms/90/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Fomenta un entorno de reconocimiento a las todas contribuciones individuales, fortaleciendo las relaciones.',
                    'scorm' => '/scorms/97/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Escucha atentamente a su equipo y atiende sus inquietudes, generando confianza mutua.',
                    'scorm' => '/scorms/91/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);

        $skill_id = Skill::insertGetId([
            'name' => 'PROMOCIÓN DE CONFIANZA',
            'description' => 'Capacidad para crear un ambiente de trabajo positivo y motivador, promoviendo la confianza, el reconocimiento y el desarrollo de los colaboradores para potenciar su desempeño y compromiso.',
            'is_active' => true,
            'created_at' => now(),
        ]);
        SkillBehavior::insert([
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Destaca y valora los éxitos y aportes del equipo de forma clara y en el momento adecuado, fomentando el entusiasmo e involucramiento de los miembros.',
                    'scorm' => '/scorms/98/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Fomenta un entorno de reconocimiento a las todas contribuciones individuales, fortaleciendo las relaciones.',
                    'scorm' => '/scorms/97/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Ofrece retroalimentación oportuna y específica, ayudando a cada miembro a fortalecer sus habilidades y maximizar su contribución a los objetivos comunes.',
                    'scorm' => '/scorms/101/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
            [
                'skill_id' => $skill_id,
                'behavior_id' => Behavior::insertGetId([
                    'name' => 'Escucha atentamente a su equipo y atiende sus inquietudes, generando confianza mutua.',
                    'scorm' => '/scorms/91/',
                    'level' => 3,
                    'is_question' => true,
                    'is_active' => true
                ])
            ],
        ]);
    }
}
