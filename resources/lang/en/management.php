<?php

return [

    'global' => [
        'yes' => 'Да',
        'create' => 'Создать',
        'delete' => 'Удалить',
        'edit' => 'Редактировать',

        'select' => [
            'empty' => 'Не выбрано'
        ]
    ],

    'property' => [
        'empty' => 'свойство не установлено'
    ],

    'organization' => [
        'type' => [
            'legal' => 'юридическая',
            'private' => 'частное'
        ],
        'saved' => 'Организация успешно сохранена',
        'create' => 'Организация успешно создана'
    ],

    'atcClassification' => [
        'created' => 'АТС классификация создана',
        'saved' => 'АТС классификация сохранена'
    ],

    'department' => [
        'statistic' => 'Статистика отделения',
        'patients' => 'Пациенты',
        'workers' => 'Работники',
        'storage' => 'Склад',
        'sets' => 'Наборы',

        'tabs' => [
            'statistic' => [
                'code' => 'Код отделения',
                'beds_amount' => 'Количество коек',
                'beds_amount_in_repair' => 'Количество коек в ремонте',
                'female_beds_amount' => 'Количество женских коек',
                'male_beds_amount' => 'Количество мужских коек'
            ],

            'patients' => [
                'name' => 'ФИО пациента',
                'diagnosis' => 'Диагноз',
                'hospitalization_date' => 'Дата госпитализации',
            ],

            'workers' => [
                'name' => 'ФИО работника',
                'position_name' => 'Должность',
                'current_cures_count' => 'Количество пациентов'
            ],

            'storage' => [
                'nomenclature' => 'Номенклатура',
                'in_stock' => 'В наличии',
                'armored' => 'Заброинровано'
            ]
        ]
    ],

    'breadcrumbs' => [
        'index' => 'EHospital',
        'organization' => [
            'title' => "Организации",
            'index' => 'Список организаций'
        ],
        'user' => [
            'title' => 'Пользователи'
        ],
        'contractor' => [
            'title' => 'Контрагенты',
            'show' => 'Просмотр контрагента'
        ],
        'department' => [
            'title' => 'Отделения',
            'current' => 'Отделение'
        ],
        'manufacturer' => [
            'title' => 'Производители'
        ],
        'nomenclature' => [
            'title' => 'Номенклатуры',
            'show' => 'Просмотр номенклатуры'
        ],
        'atcClassification' => [
            'title' => 'АТС классификации'
        ],
        'patient' => [
            'title' => 'Пациенты',
            'hospitalization' => 'Госпитализация',
            'create' => 'Новая карточка пациента'
        ],
        'sourceOfFinancing' => [
            'title' => 'Источники финансирования'
        ],
        'nomenclatureIncome' => [
            'title' => 'Поступление товаров'
        ],
        'permission' => [
            'title' => 'Права доступа'
        ]
    ],

    'label' => [
        'save' => 'Сохранить',
        'create' => 'Создать',

        'pagination' => [
            'next' => 'следующая страница',
            'previous' => 'предыдущая страница'
        ],

        'organization' => [
            'type' => 'Тип организации',
            'name' => 'Название организации',
            'legal' => 'Юр. лицо',
            'private' => 'Физ. лицо'
        ],

        'nomenclature' => [
            'info' => 'Общая информация',
            'revisions' => 'Изменения',
            'series' => 'Серии',
            'statistic' => 'Статистика',
            'income' => 'Поступление',
            'outgoing' => 'Отпуск в отделение'
        ],

        'user' => [
            'info' => 'О пользователе',
            'schedule' => 'График работы',
            'timeDelta' => 'На пациента отведено <b>:delta</b> часов'
        ],

        'patient' => [
            'card' => 'Информация о пациенте',
            'phone' => 'Телефон',
            'birthday' => 'День рождения',
            'homeless' => 'Бездомный',
            'ukrainian' => 'Украинец',
            'hospital_employee' => 'Работник больницы',
            'doctors' => 'Доктора',
            'noCures' => 'нет курсов лечения',
            'hospitalization' => 'Госпитализация',

            'inspection' => [
                'edit' => 'Редактировать первичный осмотр',

                'bloodGroup' => 'Группа крови',
                'rhFactor' => 'Резус фактор',
                'bloodTransfusions' => 'Переливания крови',

                'rhFactorPositive' => 'Позитивный',
                'rhFactorNegative' => 'Негативный'
            ],

            'cures' => [
                'title' => 'Курсы лечения',
                'empty' => 'У пациента ещё нет курсов лечения'
            ],

            'cure' => [
                'hospitalized' => 'Госпитализирован :date',
                'doctor' => 'Лечащий врач: :doctor',
                'discharge' => 'Выписан: :date',
                'show' => 'Показать курс лечения'
            ]
        ],

        'atcClassification' => [
            'noParentCategory' => 'Подкатегория'
        ],

        'contractor' => [
            'edrpou' => "ЄДРПОУ",
            'name' => "Название",
            'fullName' => 'Полное название',
            'type' => 'Тип',
            'phone' => 'Номер телефона',
            'description' => 'Описание',
            'addAddress' => 'Добавить адрес',

            'info' => 'Базовая информация',
            'addresses' => 'Адреса',
            'documents' => 'Документы',

            'addressPopup' => [
                'header' => 'Добавление адреса'
            ],

            'address' => [
                'create' => 'Создать адрес'
            ],

            'agreement' => [
                'create' => 'Создать договор'
            ]
        ],

        'cure' => [
            'comments' => 'Комментарии',
            'flow' => 'Лист назначения',

            'review' => [
                'need' => 'Создан новый курс назначения',
                'title' => 'Просмотр назначения'
            ],

            'card' => [
                'title' => 'Информация о курсе лечения',
                'diagnosis' => 'Диагноз',
                'comment' => 'Комментарий',
                'hospitalization_date' => 'Дата госптализации',
                'discharge_date' => 'Дата выписки'
            ]
        ],

        'nomenclatureIncome' => [
            'info' => 'Информация',
            'nomenclatures' => 'Номенклатуры'
        ]

    ],

    // Тексты уведомлений
    'notification' => [
        'nomenclature' => [
            'modified' => 'Номенклатура успешно сохранён',

            'request' => [
                'title' => 'Новый запрос номенклатур',
                'action' => [
                    'open' => 'Открыть запрос'
                ]
            ]
        ],

        'patient' => [
            'modified' => 'Данные пациента успешно сохранены'
        ],

        'contractor' => [
            'address' => [
                'created' => 'Адрес успешно создан',
                'deleted' => 'Адрес успешно удалён'
            ],
            'agreement' => [
                'created' => 'Договор успешно создан'
            ]
        ],

        'sourceOfFinancing' => [
            'created' => 'Источник финансирвоания успешно создан',
            'deleted' => 'Источник финансирования успешно удалён'
        ],

        'cure' => [
            'rejected' => 'Курс лечения отклонён',
            'need_head_nurse_review' => 'Создан новый курс лечения',

            'nomenclature' => [
                'notAccepted' => 'Номенклатуры ещё не выделены для лечения этого пациента'
            ],

            'action' => [
                'open' => 'Открыть курс лечения'
            ]
        ]
    ],

    'ui' => [
        'select' => [
            "choose" => "Выбрать",
            "search" => [
                "placeholder" => "Введите фразу для поиска"
            ],
        ],

        'form' => [
            'send' => 'Отправить'
        ],

        'hospitalization' => [
            'item' => [
                'delete' => 'удалить',
                'edit' => 'редактировать'
            ]
        ]
    ]
];