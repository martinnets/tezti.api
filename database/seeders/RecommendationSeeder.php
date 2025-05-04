<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\Recommendation;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recommendation::truncate();

        $skill_id = Skill::where('name', 'COMUNICACIÓN E INFLUENCIA')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Presenta baja capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Practicar presentaciones informales con colegas.',
                                    'Implementar ejercicios de escucha activa en reuniones pequeñas.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Solicitar retroalimentación de un colega sobre mensajes clave.',
                                    'Observar a un mentor en situaciones de comunicación persuasiva.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Effective Communication" - University of Cambridge (edX).',
                                    'Curso: "Communicating Effectively" - University of Toronto (Coursera).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Comunicación efectiva: escucha activa y persuasión" - Universidad Nacional Autónoma de México (UNAM) en Coursera.',
                                    'Curso: "Fundamentos de la comunicación efectiva" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Presenta mediana capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Liderar reuniones para transmitir ideas a grupos diversos.',
                                    'Crear guiones para presentaciones importantes.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en debates internos para fortalecer habilidades persuasivas.',
                                    'Unirse a un grupo de Toastmasters para perfeccionar el discurso público.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Advanced Communication Skills" - University of London (Coursera).',
                                    'Curso: "Persuasive Communication" - Stanford Online.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Habilidades de comunicación avanzada" - Tecnológico de Monterrey (TEC) en Coursera.',
                                    'Curso: "Técnicas de comunicación profesional" - Universidad de los Andes en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Presenta alta capacidad para entregar mensajes de forma clara y concisa a través de la articulación de ideas, la escucha activa y el desarrollo de relaciones para ganar aceptación de las propias ideas y persuadir al interlocutor.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Presentar en conferencias o eventos corporativos.',
                                    'Capacitar a otros en técnicas avanzadas de influencia.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Ser mentor en habilidades de comunicación en la empresa.',
                                    'Participar en paneles de discusión de la industria.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Leadership Communication" - Harvard Extension School.',
                                    'Curso: "Communicating with Influence" - University of Cambridge.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Liderazgo y comunicación efectiva" - Universidad de Barcelona (UB) en Coursera.',
                                    'Curso: "Comunicación persuasiva para líderes" - Universidad Autónoma de Madrid (UAM) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'ORIENTACIÓN A RESULTADOS')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para establecer objetivos, direccionar recursos y optimizar procesos para cumplir objetivos en el tiempo preestablecido.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Dividir grandes objetivos en tareas pequeñas con plazos claros.',
                                    'Priorizar tareas usando herramientas simples como Trello.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Solicitar orientación semanal a un líder sobre el enfoque en resultados.',
                                    'Observar a colegas en procesos de planificación estratégica.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Goal Setting and Productivity" - University of Michigan (Coursera).',
                                    'Curso: "Strategic Prioritization" - Wharton School (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Productividad personal y gestión del tiempo" - Pontificia Universidad Católica de Chile (PUC) en Coursera.',
                                    'Curso: "Estrategias para el logro de objetivos" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Presenta mediana capacidad para establecer objetivos, direccionar recursos u optimizar procesos para llevarlos a su consecución y cierre en el tiempo preestablecido, garantizando el cumplimiento de su ejecución. ',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Diseñar planes detallados de proyectos con recursos y plazos.',
                                    'Implementar indicadores de desempeño (KPIs) semanales.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en un programa de mentoría con un líder senior.',
                                    'Trabajar en equipos multifuncionales para optimizar procesos.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Strategic Management for Leaders" - London Business School (FutureLearn).',
                                    'Taller: "Effective Goal Setting for Managers" - Harvard Business School Online.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Gestión de prioridades y trabajo eficiente" - IE Business School en Coursera.',
                                    'Curso: "Planificación estratégica personal" - Tecnológico de Monterrey (TEC) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para establecer objetivos, direccionar recursos y optimizar procesos para lograr el cumplimiento en el tiempo preestablecido, garantizando la ejecución.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Coordinar proyectos estratégicos de alto impacto.',
                                    'Implementar metodologías ágiles para optimizar procesos.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Mentorear a colegas en la definición de objetivos estratégicos.',
                                    'Participar en grupos profesionales sobre mejores prácticas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Advanced Strategic Management" - INSEAD.',
                                    'Curso: "Maximizing Team Performance" - Stanford GSB.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Estrategias avanzadas para la gestión de proyectos" - Universidad de los Andes en Coursera.',
                                    'Curso: "Liderazgo y ejecución estratégica" - Universidad de Barcelona (UB) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'TRABAJO EN EQUIPO')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para participar activamente como miembro de un grupo y mantener vínculos positivos.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en reuniones colaborativas para proyectos pequeños.',
                                    'Apoyar la resolución de conflictos dentro del equipo.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Pedir retroalimentación a un compañero sobre interacción en grupo.',
                                    'Observar cómo los líderes fomentan la colaboración.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Teamwork Skills: Communicating Effectively in Groups" - University of Colorado Boulder (Coursera).',
                                    'Curso: "Collaboration and Team Dynamics" - University of Illinois (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Trabajo en equipo: colaboración efectiva" - Tecnológico de Monterrey (TEC) en Coursera.',
                                    'Curso: "Cómo trabajar en equipo con éxito" - Universidad de los Andes en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Demuestra mediana capacidad para participar activamente como miembro de un grupo, construyendo relaciones en el mismo y trabajando hacia un propósito común, manteniendo vínculos positivos.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Facilitar sesiones de lluvia de ideas en equipo.',
                                    'Proponer actividades para fortalecer la cohesión grupal.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en programas de coaching grupal.',
                                    'Unirse a proyectos transversales para interactuar con diferentes áreas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Taller: "Building High-Performing Teams" - Harvard Business School Online.',
                                    'Programa: "Leading Teams" - University of Michigan (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Construcción de equipos de alto desempeño" - Pontificia Universidad Católica de Chile (PUC) en Coursera.',
                                    'Curso: "Habilidades de colaboración en equipos multiculturales" - IE Business School en Coursera.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para participar activamente en un equipo, construyendo relaciones y trabajando hacia un propósito común, mientras se mantienen vínculos positivos.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Liderar equipos en proyectos complejos.',
                                    'Establecer dinámicas de equipo para maximizar resultados.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Mentorear a miembros del equipo para potenciar sus habilidades colaborativas.',
                                    'Representar al equipo en reuniones de alta dirección.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Advanced Team Leadership" - MIT Sloan School of Management.',
                                    'Programa: "Global Team Collaboration" - Stanford Online.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Liderando equipos globales y multidisciplinarios" - Universidad de Barcelona (UB) en Coursera.',
                                    'Curso: "Gestión avanzada de equipos de alto rendimiento" - Universidad Nacional Autónoma de México (UNAM) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'RESOLUCIÓN DE PROBLEMAS')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para detectar problemas u oportunidades, analizar información e iniciar acciones de solución utilizando recursos.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Identificar problemas recurrentes en procesos y proponer soluciones simples.',
                                    'Documentar lecciones aprendidas al resolver un problema específico.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Pedir retroalimentación a un líder sobre análisis de problemas.',
                                    'Observar cómo otros solucionan desafíos en reuniones internas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Critical Thinking and Problem Solving" - University of Leeds (FutureLearn).',
                                    'Curso: "Problem-Solving Skills for Business" - University of California, Irvine (Coursera).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Pensamiento crítico para la resolución de problemas" - Universidad Nacional Autónoma de México (UNAM) en Coursera.',
                                    'Curso: "Técnicas de resolución de problemas cotidianos" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Demuestra mediana capacidad para detectar de manera efectiva problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando diferentes recursos para atender la problemática. ',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en análisis de causa raíz para problemas más complejos.',
                                    'Implementar un plan de acción para solucionar problemas en un proyecto clave.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Colaborar en sesiones de resolución de problemas multifuncionales.',
                                    'Unirse a talleres internos sobre pensamiento crítico y análisis.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Taller: "Practical Problem Solving Tools" - MIT Sloan School of Management.',
                                    'Curso: "Complex Problem Solving" - Harvard Business School Online.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Análisis y solución de problemas empresariales" - Tecnológico de Monterrey (TEC) en Coursera.',
                                    'Curso: "Toma de decisiones efectiva" - Universidad de los Andes en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para detectar problemas u oportunidades, analizar información e iniciar acciones a través del desarrollo de soluciones, anticipando y utilizando recursos de manera efectiva para atender las problemáticas.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Diseñar e implementar estrategias para prevenir problemas recurrentes.',
                                    'Facilitar talleres de resolución de problemas para equipos.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Actuar como mentor en análisis y solución de problemas dentro del equipo.',
                                    'Participar en conferencias relacionadas con innovación y gestión de problemas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Advanced Critical Thinking" - INSEAD.',
                                    'Curso: "Decision Making and Problem Solving" - University of Pennsylvania (Wharton).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Estrategias avanzadas para resolver problemas complejos" - Universidad de Barcelona (UB) en Coursera.',
                                    'Curso: "Soluciones innovadoras para problemas críticos" - IE Business School en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'DISPOSICIÓN AL SERVICIO Y CLIENTE')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para mantener relaciones positivas con clientes, motivado por el deseo de servir.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Responder proactivamente a solicitudes básicas de clientes.',
                                    'Registrar las quejas más comunes y sugerir pequeñas mejoras.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Pedir retroalimentación a colegas sobre interacciones con clientes.',
                                    'Observar cómo los líderes manejan quejas o solicitudes críticas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Customer Service Fundamentals" - University of Maryland (edX).',
                                    'Curso: "Service Excellence in Business" - University of Queensland (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Atención al cliente y experiencia de servicio" - Universidad Nacional Autónoma de México (UNAM) en Coursera.',
                                    'Curso: "Introducción al servicio al cliente" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Demuestra mediana capacidad para digirir acciones hacia el mantenimiento de las relaciones positivas con los clientes, motivados por el deseo de ayudar o servir.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Diseñar soluciones personalizadas para las solicitudes de clientes más complejas.',
                                    'Implementar encuestas rápidas para medir la satisfacción de los clientes.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en programas de mentoría con expertos en atención al cliente.',
                                    'Unirse a reuniones de equipo centradas en experiencias del cliente.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Customer Experience Strategy" - Columbia Business School (Coursera).',
                                    'Curso: "Customer Relationship Management" - London School of Economics (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Excelencia en la atención al cliente" - Tecnológico de Monterrey (TEC) en Coursera.',
                                    'Curso: "Estrategias para fidelizar clientes" - Pontificia Universidad Católica de Chile (PUC) en Coursera.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para dirigir acciones hacia el mantenimiento de relaciones positivas con los clientes, motivado por el deseo de ayudar o servir.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Liderar la creación de iniciativas para mejorar la experiencia del cliente.',
                                    'Implementar métricas avanzadas para medir la satisfacción y fidelización.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Mentorear a colegas en la resolución de casos críticos de clientes.',
                                    'Participar en foros de la industria sobre innovación en atención al cliente.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Customer-Centric Leadership" - INSEAD.',
                                    'Curso: "Service Leadership" - Cornell University (eCornell).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Liderazgo centrado en el cliente" - Universidad de los Andes en Coursera.',
                                    'Curso: "Gestión avanzada de la experiencia del cliente" - IE Business School en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'AUTOGESTIÓN')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para determinar eficazmente tareas y prioridades entre un conjunto de actividades.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Priorizar tareas diarias con el uso de herramientas básicas como listas de verificación.',
                                    'Establecer un horario semanal para cumplir plazos de proyectos.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Solicitar retroalimentación semanal de un supervisor sobre el manejo del tiempo.',
                                    'Observar cómo los líderes planifican y ejecutan sus prioridades.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Time Management for Professionals" - University of California, Irvine (Coursera).',
                                    'Curso: "Personal Productivity" - Imperial College London (edX).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Gestión del tiempo y productividad personal" - Pontificia Universidad Católica de Chile (PUC) en Coursera.',
                                    'Curso: "Organización personal efectiva" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Demuestra mediana capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Establecer objetivos trimestrales alineados con las metas de la organización.',
                                    'Usar herramientas avanzadas de gestión de tiempo como Asana o Notion.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en grupos de trabajo donde se compartan mejores prácticas de autogestión.',
                                    'Unirse a sesiones de coaching enfocadas en la mejora de hábitos.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Taller: "Mastering Self-Leadership" - Harvard Business School Online.',
                                    'Curso: "Strategic Time Management" - University of Oxford (FutureLearn).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Planificación estratégica personal y profesional" - IE Business School en Coursera.',
                                    'Curso: "Productividad avanzada: hábitos y herramientas" - Tecnológico de Monterrey (TEC) en Coursera.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para determinar eficazmente las tareas y prioridades entre un conjunto de actividades, estableciendo un curso de acción basado en plazos, recursos requeridos y seguimiento.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Implementar metodologías como GTD (Getting Things Done) para organizar tareas complejas.',
                                    'Optimizar recursos en proyectos críticos para mejorar la eficiencia personal.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Mentorear a colegas en la planificación y ejecución de tareas clave.',
                                    'Participar en redes profesionales sobre productividad personal y organizacional.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Executive Leadership and Productivity" - Stanford Graduate School of Business.',
                                    'Curso: "High-Performance Leadership" - INSEAD.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Autogestión para líderes empresariales" - Universidad de Barcelona (UB) en Coursera.',
                                    'Curso: "Estrategias para maximizar el rendimiento personal" - Universidad Nacional Autónoma de México (UNAM) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
        $skill_id = Skill::where('name', 'INTUICIÓN COMERCIAL')->first()->id;
        Recommendation::insert([
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '1')->first()->id,
                'indicators' => 'Baja capacidad para identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones en ventas.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Realizar análisis básicos de datos de ventas para identificar oportunidades.',
                                    'Observar tendencias del mercado en reportes internos.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Participar en reuniones con vendedores experimentados.',
                                    'Solicitar retroalimentación sobre propuestas comerciales realizadas.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Sales Strategies: Mastering the Art of Selling" - University of Michigan (Coursera).',
                                    'Curso: "Market Insights for Business" - London Business School (FutureLearn).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Fundamentos de ventas y negociación" - Universidad Nacional Autónoma de México (UNAM) en Coursera.',
                                    'Curso: "Introducción a la inteligencia de mercado" - Universitat Politècnica de València (UPV) en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '2')->first()->id,
                'indicators' => 'Demuestra mediana capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial, para proponer soluciones que agreguen valor a los clientes.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Diseñar propuestas de valor personalizadas para clientes clave.',
                                    'Analizar métricas avanzadas para identificar oportunidades de negocio.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Unirse a comunidades de ventas para compartir experiencias.',
                                    'Participar en programas de mentoría con expertos comerciales.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Commercial Acumen" - University of Oxford (edX).',
                                    'Programa: "Business Market Strategy" - Wharton School (Coursera).',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Curso: "Estrategias comerciales para mercados competitivos" - Tecnológico de Monterrey (TEC) en Coursera.',
                                    'Curso: "Gestión avanzada de oportunidades comerciales" - Pontificia Universidad Católica de Chile (PUC) en Coursera.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
            [
                'skill_id' => $skill_id,
                'classification_id' => Classification::where('code', '3')->first()->id,
                'indicators' => 'Alta capacidad para comprender las necesidades y desafíos de los clientes, identificar oportunidades de negocio, anticipar tendencias del mercado y manejar objeciones durante el proceso comercial para proponer soluciones que agreguen valor a los clientes.',
                'list' => json_encode([
                    [
                        0 => [
                            '70% Experiencia Práctica' => [
                                'type' => 'actions',
                                'list' => [
                                    'Liderar estrategias comerciales basadas en análisis de mercado avanzados.',
                                    'Desarrollar alianzas estratégicas con clientes clave.',
                                ]
                            ],
                        ],
                        1 => [
                            '20% Aprendizaje Social' => [
                                'type' => 'actions',
                                'list' => [
                                    'Mentorear a equipos de ventas para optimizar su enfoque comercial.',
                                    'Participar en foros globales de ventas y marketing.',
                                ]
                            ],
                        ],
                        2 => [
                            '10% Formación Formal (Inglés)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Strategic Sales Leadership" - INSEAD.',
                                    'Curso: "Leading the Future of Sales" - Harvard Business School Online.',
                                ]
                            ],
                        ],
                        3 => [
                            '10% Formación Formal (Español)' => [
                                'type' => 'actions',
                                'list' => [
                                    'Programa: "Liderazgo estratégico en ventas" - Universidad de los Andes en Coursera.',
                                    'Curso: "Tendencias y estrategias comerciales avanzadas" - IE Business School en edX.',
                                ]
                            ],
                        ],
                    ]
                ])
            ],
        ]);
    }
}
