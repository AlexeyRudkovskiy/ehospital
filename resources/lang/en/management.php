<?php

return [

    'global' => [
        'yes' => 'Да',
        'create' => 'Создать',
        'delete' => 'Удалить',
        'edit' => 'Редактировать'
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
            'title' => 'Отделения'
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
            'title' => 'Поступление номенклатуры'
        ],
        'permission' => [
            'title' => 'Права доступа'
        ]
    ],

    'label' => [
        'save' => 'Сохранить',
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
            ]
        ],

        'cure' => [
            'comments' => 'Комментарии'
        ]

    ],

    // Тексты уведомлений
    'notification' => [
        'nomenclature' => [
            'modified' => 'Номенклатура успешно сохранён'
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
        ]
    ]
];