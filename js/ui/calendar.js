System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function onPrevMonthButtonClicked() {
        this.calendar.setMonth(this.calendar.currentYear, this.calendar.currentMonth - 1);
    }
    function onNextMonthButtonClicked() {
        this.calendar.setMonth(this.calendar.currentYear, this.calendar.currentMonth + 1);
    }
    function createCalendars(target, predefined) {
        if (predefined === void 0) { predefined = {}; }
        var calendar = new CalendarWrapper();
        var prevMonthButton = target.querySelector('.prev-month');
        var nextMonthButton = target.querySelector('.next-month');
        var currentDate = new Date();
        calendar.element = target;
        calendar.currentMonthLabel = target.querySelector('.current-month');
        calendar.calendarDatesTable = target.querySelector('.calendar-content > table > tbody');
        calendars.push(calendar);
        calendar.datesContainer = predefined;
        calendar.setMonth(currentDate.getFullYear(), currentDate.getMonth());
        prevMonthButton.addEventListener('click', onPrevMonthButtonClicked.bind({
            calendar: calendar
        }));
        nextMonthButton.addEventListener('click', onNextMonthButtonClicked.bind({
            calendar: calendar
        }));
        return calendar;
    }
    exports_1("createCalendars", createCalendars);
    var CalendarWrapper, calendars;
    return {
        setters: [],
        execute: function () {
            CalendarWrapper = (function () {
                function CalendarWrapper() {
                    this.globalConfig = {};
                    this.currentMonthLabel = null;
                    this.calendarDatesTable = null;
                    this.onDayClicked = null;
                    this.registeredCells = [];
                    this.labels = [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ];
                    this.datesContainer = {};
                }
                CalendarWrapper.prototype.setMonth = function (year, month) {
                    if (month > 11) {
                        month = 0;
                        year++;
                    }
                    if (month < 0) {
                        month = 11;
                        year--;
                    }
                    var prevMonth = new Date(year, month, 0);
                    this.currentYear = year;
                    this.currentMonth = month;
                    this.daysInCurrentMonth = (new Date(year, month + 1, 0)).getDate();
                    this.daysInPrevMonth = (prevMonth).getDate();
                    this.prevMonthLastDayInWeek = (prevMonth).getDay();
                    if (this.prevMonthLastDayInWeek == 0) {
                        this.prevMonthLastDayInWeek = 7;
                    }
                    this.prevMonthLastDayInWeek--;
                    if (this.currentMonthLabel !== null) {
                        this.currentMonthLabel.innerHTML = this.labels[month];
                    }
                    this.redrawTable();
                };
                CalendarWrapper.prototype.redrawTable = function () {
                    while (this.calendarDatesTable.firstElementChild) {
                        this.calendarDatesTable.removeChild(this.calendarDatesTable.firstElementChild);
                    }
                    var tr = document.createElement('tr');
                    var totalDays = this.prevMonthLastDayInWeek + 1;
                    var nextMonthDays = 1;
                    this.registeredCells.splice(0, this.registeredCells.length);
                    for (var i = 0; i <= this.prevMonthLastDayInWeek; i++) {
                        var td = document.createElement('td');
                        var dayWrapper = document.createElement('span');
                        dayWrapper.classList.add('day-wrapper');
                        td.classList.add('disabled');
                        dayWrapper.innerHTML = (this.daysInPrevMonth - (this.prevMonthLastDayInWeek - i)).toString();
                        tr.appendChild(td);
                        td.appendChild(dayWrapper);
                    }
                    for (var i = 1; i <= this.daysInCurrentMonth; i++) {
                        var td = document.createElement('td');
                        var dayWrapper = document.createElement('span');
                        dayWrapper.classList.add('day-wrapper');
                        dayWrapper.innerHTML = i.toString();
                        tr.appendChild(td);
                        td.appendChild(dayWrapper);
                        var dayTag = [i, (this.currentMonth + 1), this.currentYear].join('.');
                        td.setAttribute('data-tag', dayTag);
                        td.addEventListener('click', this.onDayClickedCallback.bind({
                            element: td,
                            calendar: this
                        }));
                        if (typeof this.datesContainer[dayTag] !== "undefined" && (this.datesContainer[dayTag].nomenclatures.length > 0 ||
                            this.datesContainer[dayTag].procedures.length > 0)) {
                            td.classList.add('active');
                        }
                        totalDays++;
                        if (totalDays % 7 === 0) {
                            this.calendarDatesTable.appendChild(tr);
                            tr = document.createElement('tr');
                        }
                        this.registeredCells.push(td);
                    }
                    while (totalDays % 7 !== 0) {
                        var td = document.createElement('td');
                        var dayWrapper = document.createElement('span');
                        dayWrapper.classList.add('day-wrapper');
                        td.classList.add('disabled');
                        dayWrapper.innerHTML = nextMonthDays.toString();
                        tr.appendChild(td);
                        td.appendChild(dayWrapper);
                        totalDays++;
                        nextMonthDays++;
                    }
                    this.calendarDatesTable.appendChild(tr);
                };
                CalendarWrapper.prototype.replaceDayDate = function (day, value) {
                    if (typeof this.datesContainer[day] === "undefined") {
                        this.datesContainer[day] = {};
                    }
                    this.datesContainer[day] = value;
                };
                CalendarWrapper.prototype.removeDayDate = function (day) {
                    if (typeof this.datesContainer[day] !== "undefined") {
                        delete this.datesContainer[day];
                    }
                };
                CalendarWrapper.prototype.getDayDate = function (day) {
                    if (typeof this.datesContainer[day] === "undefined") {
                        this.datesContainer[day] = {};
                    }
                    return this.datesContainer[day];
                };
                CalendarWrapper.prototype.onDayClickedCallback = function () {
                    if (this.calendar.onDayClicked !== null) {
                        this.calendar.onDayClicked.apply(window, [
                            this.element.getAttribute('data-tag'),
                            this.calendar.getDayDate(this.element.getAttribute('data-tag')),
                            this.calendar
                        ]);
                    }
                    for (var i = 0; i < this.calendar.registeredCells.length; i++) {
                        if (this.calendar.registeredCells[i].classList.contains('highlight')) {
                            this.calendar.registeredCells[i].classList.remove('highlight');
                        }
                    }
                    this.element.classList.add('highlight');
                };
                return CalendarWrapper;
            }());
            exports_1("CalendarWrapper", CalendarWrapper);
            calendars = [];
        }
    };
});

//# sourceMappingURL=calendar.js.map
