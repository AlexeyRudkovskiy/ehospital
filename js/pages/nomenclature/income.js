System.register(["../../api", "/income_template.html!text", "../../application", "../../ui/select"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function nomenclatureIncome() {
        // contractorsSelect = document.querySelector('#contractor_select');
        // agreementsSelect = document.querySelector('#agreement_select');
        addRow = document.querySelector('#addRow');
        container = document.querySelector('.income-container');
        addRow.addEventListener('click', addRowEventListener);
        var contractorSelect = select_1.findSelectById('contractor_select');
        var agreementSelect = select_1.findSelectById('agreements_select');
        contractorSelect.addOnChangeEventListener(function (contractor) {
            agreementSelect.processItems(contractor.metadata.agreements.map(function (i) {
                return {
                    text: i.from + ' - ' + i.until,
                    value: i.id,
                    isSelected: false
                };
            }));
            agreementSelect.setPlaceholderText();
        });
    }
    exports_1("default", nomenclatureIncome);
    function contractorChangeEventListener() {
        while (agreementsSelect.firstElementChild) {
            agreementsSelect.removeChild(agreementsSelect.firstElementChild);
        }
        api_1.default.get('/api/contractor/' + contractorsSelect.value)
            .then(function (response) { return response.json(); })
            .then(function (response) { return populateAgreementsSelect(response); });
    }
    function populateAgreementsSelect(data) {
        for (var i = 0; i < data.agreements.length; i++) {
            var option = document.createElement('option');
            option.setAttribute('value', data.agreements[i].id);
            option.innerHTML = data.agreements[i].from + ' - ' + data.agreements[i].until;
            agreementsSelect.appendChild(option);
        }
    }
    function addRowEventListener() {
        var temp = document.createElement('div');
        var tmp = income_template_html_text_1.default;
        while (tmp.indexOf('{i}') > -1) {
            tmp = tmp.replace("{i}", counter.toString());
        }
        temp.innerHTML = tmp;
        var table = temp.firstElementChild;
        container.appendChild(table);
        var tableBody = table.querySelector('tbody');
        var addBatch = table.querySelector('.add-batch');
        var deleteNomenclature = table.querySelector('[data-delete-nomenclature]');
        addBatch.addEventListener('click', function () {
            var _temp = document.createElement('tbody');
            var rowTemplate = this.temp.querySelector('template#batch_row').innerHTML;
            while (rowTemplate.indexOf('{row}') > -1) {
                rowTemplate = rowTemplate.replace("{row}", this.rows.toString());
            }
            this.rows++;
            _temp.innerHTML = rowTemplate;
            var row = _temp.firstElementChild;
            this.body.appendChild(row);
            row.querySelector('[data-price]').addEventListener('input', recalculate.bind(row));
            row.querySelector('[data-amount]').addEventListener('input', recalculate.bind(row));
            row.querySelector('[data-nds]').addEventListener('input', recalculate.bind(row));
            row.querySelector('[data-delete-row]').addEventListener('click', function () {
                var row = this.parentElement.parentElement;
                row.parentElement.removeChild(row);
            });
        }.bind({
            temp: temp,
            body: tableBody,
            rows: 0
        }));
        deleteNomenclature.addEventListener('click', function () {
            var row = this.parentElement.parentElement.parentElement.parentElement.parentElement;
            row.parentElement.removeChild(row);
        });
        application_1.default.callEmmitable('select');
        // todo: оптимизировать: передавать источник события?
        counter++;
    }
    function recalculate() {
        var target = this.querySelector('[data-total]');
        var targetInput = this.querySelector('[data-total-input]');
        var price = this.querySelector('[data-price]').value;
        var amount = this.querySelector('[data-amount]').value;
        var nds = this.querySelector('[data-nds]').value;
        nds /= 100;
        nds += 1;
        // debugger;
        var total = Number(price) * Number(amount) * nds;
        if (!isNaN(total)) {
            target.innerHTML = total.toFixed(2);
            targetInput.value = total.toFixed(2);
        }
    }
    var api_1, income_template_html_text_1, application_1, select_1, contractorsSelect, agreementsSelect, addRow, container, counter;
    return {
        setters: [
            function (api_1_1) {
                api_1 = api_1_1;
            },
            function (income_template_html_text_1_1) {
                income_template_html_text_1 = income_template_html_text_1_1;
            },
            function (application_1_1) {
                application_1 = application_1_1;
            },
            function (select_1_1) {
                select_1 = select_1_1;
            }
        ],
        execute: function () {
            contractorsSelect = null;
            agreementsSelect = null;
            addRow = null;
            container = null;
            counter = 0;
        }
    };
});

//# sourceMappingURL=income.js.map
