System.register(["../../ui/calendar", "../../ui/popup/popup", "./hospitalization-popup-content-builder", "../../lang", "../../ui/select", "../../api", "./hospitalization-popup-content-builder-extended", "./hospitalization-popup-procedure-content-builder"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function deleteItemCallback() {
        var item = this.item;
        var rawItem = this.rawItem;
        var day = this.day;
        var type = this.type;
        day[type].splice(day[type].indexOf(rawItem), 1);
        item.parentElement.removeChild(item);
    }
    function editItemCallback() {
        var editPopup = new popup_1.default(null, "Редактирование элемента", "");
        var popupBuilder;
        if (isEditing) {
            popupBuilder = new hospitalization_popup_content_builder_extended_1.default();
            editPopup.onPopupAppeared = popupBuilder.onPopupAppeared.bind(popupBuilder);
        }
        else {
            popupBuilder = new hospitalization_popup_content_builder_1.default();
        }
        var rawItem = this.rawItem;
        var day = this.day;
        popupBuilder.popup = editPopup;
        editPopup.basicContentBuilder = popupBuilder;
        editPopup.isForm = true;
        editPopup.create(this.rawItem);
        editPopup.setOnSubmitEventListener(function (form) {
            debugger;
            rawItem.name = form.name.value;
            rawItem.measure = form.measure.value;
            rawItem.origin_name = form.origin_name.value;
            rawItem.nomenclature_id = form.nomenclature_id.value;
            rawItem.unit_id = form.unit_id.value;
            rawItem.amount = form.amount.value;
            rawItem.is_set = form.use_set_instead_of_nomenclature.checked;
            if (rawItem.is_set) {
                rawItem.set_id = form.set.value;
            }
            editPopup.close();
            recreateDay(day);
        });
        editPopup.show();
    }
    function editProcedureItemCallback() {
        var editPopup = new popup_1.default(null, "Редактирование элемента", "");
        var popupBuilder;
        popupBuilder = new hospitalization_popup_procedure_content_builder_1.default();
        editPopup.onPopupAppeared = popupBuilder.onPopupAppeared.bind(popupBuilder);
        var rawItem = this.rawItem;
        var day = this.day;
        popupBuilder.popup = editPopup;
        editPopup.basicContentBuilder = popupBuilder;
        editPopup.isForm = true;
        editPopup.create(this.rawItem);
        editPopup.setOnSubmitEventListener(function (form) {
            rawItem.name = form.name.value;
            rawItem.id = form.procedure.id;
            // rawItem.name = form.name.value;
            // rawItem.measure = form.measure.value;
            // rawItem.origin_name = form.origin_name.value;
            //
            // rawItem.nomenclature_id = form.nomenclature_id.value;
            // rawItem.unit_id = form.unit_id.value;
            // rawItem.amount = form.amount.value;
            editPopup.close();
            recreateDay(day);
        });
        editPopup.show();
    }
    function onDayClicked(day, dayValue, calendar) {
        if (typeof dayValue.nomenclatures === "undefined") {
            dayValue.nomenclatures = [];
            dayValue.procedures = [];
            dayValue.tag = day;
        }
        activeCalendar = calendar;
        activeDayTag = day;
        activeDay = dayValue;
        recreateDay(dayValue);
        if (dayValue.nomenclatures.length > 0 || dayValue.procedures.length > 0) {
            calendar.calendarDatesTable.querySelector('[data-tag="' + day + '"]').classList.add('active');
        }
    }
    function recreateDay(day) {
        while (medicaments.firstElementChild) {
            medicaments.removeChild(medicaments.firstElementChild);
        }
        while (procedures.firstElementChild) {
            procedures.removeChild(procedures.firstElementChild);
        }
        for (var i = 0; i < day.nomenclatures.length; i++) {
            var li = document.createElement('li');
            var name_1 = document.createElement('p');
            var measure = document.createElement('p');
            var link = document.createElement('a');
            link.setAttribute('href', 'javascript:');
            if (typeof day.nomenclatures[i].origin_name !== "undefined") {
                link.innerHTML = day.nomenclatures[i].name + ' (' + day.nomenclatures[i].origin_name + ')';
            }
            else {
                link.innerHTML = day.nomenclatures[i].name;
            }
            if (typeof day.nomenclatures[i].amount !== "undefined") {
                measure.innerHTML = day.nomenclatures[i].amount + ' (' + day.nomenclatures[i].measure + ')';
            }
            else {
                measure.innerHTML = day.nomenclatures[i].measure;
            }
            name_1.classList.add('name');
            measure.classList.add('measure');
            li.appendChild(name_1);
            li.appendChild(measure);
            name_1.appendChild(link);
            medicaments.appendChild(li);
            if (!config.justView) {
                var actions = document.createElement('div');
                var deleteButton = document.createElement('a');
                var editButton = document.createElement('a');
                var buttonsGroup = document.createElement('div');
                actions.classList.add('actions');
                buttonsGroup.classList.add('btn-group');
                deleteButton.classList.add('btn', 'btn-small');
                deleteButton.innerHTML = lang_1.default.get('ui.hospitalization.item.delete');
                deleteButton.setAttribute('href', 'javascript:');
                editButton.classList.add('btn', 'btn-small');
                editButton.innerHTML = lang_1.default.get('ui.hospitalization.item.edit');
                editButton.setAttribute('href', 'javascript:');
                var type = "nomenclatures";
                var buttonThisRedefined = {
                    item: li,
                    rawItem: day[type][i],
                    day: day,
                    type: type
                };
                deleteButton.addEventListener('click', deleteItemCallback.bind(buttonThisRedefined));
                editButton.addEventListener('click', editItemCallback.bind(buttonThisRedefined));
                li.appendChild(buttonsGroup);
                buttonsGroup.appendChild(deleteButton);
                buttonsGroup.appendChild(editButton);
            }
        }
        for (var i = 0; i < day.procedures.length; i++) {
            var item = document.createElement('li');
            var p = document.createElement('p');
            var link = document.createElement('a');
            p.classList.add('name');
            link.innerHTML = day.procedures[i].name;
            link.href = 'javascript:';
            p.appendChild(link);
            item.appendChild(p);
            procedures.appendChild(item);
            if (!config.justView) {
                var actions = document.createElement('div');
                var deleteButton = document.createElement('a');
                var editButton = document.createElement('a');
                var buttonsGroup = document.createElement('div');
                actions.classList.add('actions');
                buttonsGroup.classList.add('btn-group');
                deleteButton.classList.add('btn', 'btn-small');
                deleteButton.innerHTML = lang_1.default.get('ui.hospitalization.item.delete');
                deleteButton.setAttribute('href', 'javascript:');
                editButton.classList.add('btn', 'btn-small');
                editButton.innerHTML = lang_1.default.get('ui.hospitalization.item.edit');
                editButton.setAttribute('href', 'javascript:');
                var type = "procedures";
                var buttonThisRedefined = {
                    item: item,
                    rawItem: day[type][i],
                    day: day,
                    type: type
                };
                deleteButton.addEventListener('click', deleteItemCallback.bind(buttonThisRedefined));
                editButton.addEventListener('click', editProcedureItemCallback.bind(buttonThisRedefined));
                item.appendChild(buttonsGroup);
                buttonsGroup.appendChild(deleteButton);
                buttonsGroup.appendChild(editButton);
            }
        }
    }
    function addNewNomenclature(form) {
        activeDay.nomenclatures.push({
            name: form.name.value,
            measure: form.measure.value
        });
        if (activeDay.nomenclatures.length > 0 || activeDay.procedures.length > 0) {
            activeCalendar.calendarDatesTable.querySelector('[data-tag="' + activeDayTag + '"]').classList.add('active');
        }
        popup.close();
        recreateDay(activeDay);
    }
    function addNewProcedure(form) {
        activeDay.procedures.push({
            id: form.procedure.value,
            name: form.name.value
        });
        popup.close();
        recreateDay(activeDay);
    }
    function hospitalization() {
        var calendarTarget = document.querySelector('[data-tab="hospitalization"] .calendar-container');
        if (calendarTarget === null) {
            calendarTarget = document.querySelector('[data-tab="review"] .calendar-container, [data-tab="flow"] .calendar-container');
        }
        var calendarValue = document.querySelector('#calendar_value');
        if (calendarValue === null) {
            return;
        }
        var predefinedValue = calendarValue.value.length > 2 ? JSON.parse(calendarValue.value) : {};
        var hospitalizationForm = document.querySelector('form.steps');
        isEditing = calendarValue.value.length > 2;
        var createdCalendar = calendar_1.createCalendars(calendarTarget, predefinedValue);
        var nextStepButton = document.querySelector('.next-step');
        var cureApproveBtn = document.querySelector('#cureApproveBtn');
        activeCalendar = createdCalendar;
        if (typeof window.calendarConfig !== "undefined") {
            config = window.calendarConfig;
        }
        else {
            config = {
                justView: false
            };
        }
        var currentStep = 1;
        createdCalendar.onDayClicked = onDayClicked;
        window.createdCalendar = createdCalendar;
        calendarDay = calendarTarget.querySelector('.calendar-day');
        medicaments = calendarDay.querySelector('.medicaments');
        procedures = calendarDay.querySelector('.procedures');
        var addNomenclatureButton = calendarTarget.querySelector('.add-medicament');
        var addProcedureButton = calendarTarget.querySelector('.add-procedure');
        if (addNomenclatureButton !== null) {
            addNomenclatureButton.addEventListener('click', function () {
                popup = new popup_1.default(null, 'Добавление медикамента', 'Для даты ' + activeDay.tag);
                var popupBuilder = null;
                // todo: fix it
                // if (isEditing) {
                //     popupBuilder = new HospitalizationPopupContentBuilderExtended();
                // } else {
                popupBuilder = new hospitalization_popup_content_builder_1.default();
                // }
                popupBuilder.popup = popup;
                popup.basicContentBuilder = popupBuilder;
                popup.isForm = true;
                popup.create();
                popup.show();
                popup.setOnSubmitEventListener(addNewNomenclature);
            });
        }
        if (addProcedureButton !== null) {
            addProcedureButton.addEventListener('click', function () {
                popup = new popup_1.default(null, "Добавление процедуры", 'Для даты ' + activeDay.tag);
                var builder = new hospitalization_popup_procedure_content_builder_1.default();
                builder.popup = popup;
                popup.basicContentBuilder = builder;
                popup.isForm = true;
                popup.onPopupAppeared = builder.onPopupAppeared.bind(builder);
                popup.create();
                popup.show();
                popup.setOnSubmitEventListener(addNewProcedure);
            });
        }
        if (nextStepButton !== null) {
            nextStepButton.addEventListener('click', function () {
                if (currentStep == 1) {
                    currentStep++;
                }
                else if (currentStep == 2) {
                    var data = {};
                    for (var key in activeCalendar.datesContainer) {
                        var currentDay = activeCalendar.datesContainer[key];
                        if (currentDay !== {} &&
                            typeof currentDay.nomenclatures !== "undefined" &&
                            typeof currentDay.procedures !== "undefined" && (currentDay.nomenclatures.length > 0 ||
                            currentDay.procedures.length > 0)) {
                            data[key] = activeCalendar.datesContainer[key];
                        }
                    }
                    calendarValue.value = JSON.stringify(data);
                    hospitalizationForm.submit();
                }
            });
        }
        if (cureApproveBtn !== null) {
            cureApproveBtn.addEventListener('click', function (e) {
                var data = {};
                for (var key in activeCalendar.datesContainer) {
                    var currentDay = activeCalendar.datesContainer[key];
                    if (currentDay !== {} &&
                        typeof currentDay.nomenclatures !== "undefined" &&
                        typeof currentDay.procedures !== "undefined" && (currentDay.nomenclatures.length > 0 ||
                        currentDay.procedures.length > 0)) {
                        data[key] = activeCalendar.datesContainer[key];
                    }
                }
                calendarValue.value = JSON.stringify(data);
            });
        }
        var departmentSelect = select_1.findSelectById('hospitalization_department');
        if (departmentSelect !== null) {
            var userSelect_1 = select_1.findSelectById('user_id_select');
            departmentSelect.addOnChangeEventListener(function (option) {
                window.department = {
                    id: option.value
                };
                userSelect_1.searchUrl = '/api/search/department/' + departmentSelect.selected.value + '/users';
                api_1.default.get(userSelect_1.searchUrl)
                    .then(function (response) { return response.json(); })
                    .then(function (items) { return userSelect_1.processItems(items); })
                    .then(function (items) { return userSelect_1.setPlaceholderText(); });
            });
        }
    }
    exports_1("default", hospitalization);
    var calendar_1, popup_1, hospitalization_popup_content_builder_1, lang_1, select_1, api_1, hospitalization_popup_content_builder_extended_1, hospitalization_popup_procedure_content_builder_1, calendarDay, medicaments, procedures, activeDay, popup, activeCalendar, activeDayTag, config, isEditing;
    return {
        setters: [
            function (calendar_1_1) {
                calendar_1 = calendar_1_1;
            },
            function (popup_1_1) {
                popup_1 = popup_1_1;
            },
            function (hospitalization_popup_content_builder_1_1) {
                hospitalization_popup_content_builder_1 = hospitalization_popup_content_builder_1_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (select_1_1) {
                select_1 = select_1_1;
            },
            function (api_1_1) {
                api_1 = api_1_1;
            },
            function (hospitalization_popup_content_builder_extended_1_1) {
                hospitalization_popup_content_builder_extended_1 = hospitalization_popup_content_builder_extended_1_1;
            },
            function (hospitalization_popup_procedure_content_builder_1_1) {
                hospitalization_popup_procedure_content_builder_1 = hospitalization_popup_procedure_content_builder_1_1;
            }
        ],
        execute: function () {
            calendarDay = null;
            medicaments = null;
            procedures = null;
            activeDay = null;
            popup = null;
            activeCalendar = null;
            config = {};
            isEditing = false;
        }
    };
});

//# sourceMappingURL=hospitalization.js.map
