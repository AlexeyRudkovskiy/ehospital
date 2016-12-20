@php($isJustView = false)

<div class="calendar-container">
    <div class="calendar">
        <div class="calendar-header">
            <div class="prev-month"><<</div>
            <div class="current-month">Сентябрь</div>
            <div class="next-month">>></div>
        </div>
        <div class="calendar-content">
            <table>
                <thead>
                <tr>
                    <th>Пн</th>
                    <th>Вт</th>
                    <th>Ср</th>
                    <th>Чт</th>
                    <th>Пн</th>
                    <th>Сб</th>
                    <th>Вс</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="disabled"><span class="day-wrapper">28</span></td>
                    <td class="disabled"><span class="day-wrapper">29</span></td>
                    <td class="disabled"><span class="day-wrapper">30</span></td>
                    <td><span class="day-wrapper">1</span></td>
                    <td><span class="day-wrapper">2</span></td>
                    <td><span class="day-wrapper">3</span></td>
                    <td><span class="day-wrapper">4</span></td>
                </tr>
                <tr>
                    <td><span class="day-wrapper">5</span></td>
                    <td><span class="day-wrapper">6</span></td>
                    <td><span class="day-wrapper">7</span></td>
                    <td><span class="day-wrapper">8</span></td>
                    <td><span class="day-wrapper">9</span></td>
                    <td><span class="day-wrapper">10</span></td>
                    <td><span class="day-wrapper">11</span></td>
                </tr>
                <tr>
                    <td><span class="day-wrapper">12</span></td>
                    <td><span class="day-wrapper">13</span></td>
                    <td><span class="day-wrapper">14</span></td>
                    <td><span class="day-wrapper">15</span></td>
                    <td><span class="day-wrapper">16</span></td>
                    <td><span class="day-wrapper">17</span></td>
                    <td><span class="day-wrapper">18</span></td>
                </tr>
                <tr>
                    <td><span class="day-wrapper">19</span></td>
                    <td><span class="day-wrapper">20</span></td>
                    <td><span class="day-wrapper">21</span></td>
                    <td><span class="day-wrapper">22</span></td>
                    <td><span class="day-wrapper">23</span></td>
                    <td><span class="day-wrapper">24</span></td>
                    <td><span class="day-wrapper">25</span></td>
                </tr>
                <tr>
                    <td><span class="day-wrapper">26</span></td>
                    <td><span class="day-wrapper">27</span></td>
                    <td><span class="day-wrapper">28</span></td>
                    <td><span class="day-wrapper">29</span></td>
                    <td><span class="day-wrapper">30</span></td>
                    <td><span class="day-wrapper">31</span></td>
                    <td class="disabled"><span class="day-wrapper">1</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="calendar-footer">
            @if(isset($viewUnderCalendar))
                @include($viewUnderCalendar)
            @endif
        </div>
    </div>
    <div class="calendar-day">
        <div class="header">
            <h3>Медикаменты</h3>
            <div class="create-item">
                @if (!$isJustView)
                <a href="javascript:" class="btn btn-small add-medicament">добавить</a>
                @endif
            </div>
        </div>
        <ul class="list medicaments">
            <li>
                <p class="name"><a href="javascript:">Амброксол</a></p>
                <p class="amount">10 мл</p>
            </li>
        </ul>
        <div class="header">
            <h3>Процедуры</h3>
        </div>
        <ul class="list procedures">
            <li>
                <p class="name"><a href="javascript:">ЭКГ</a></p>
            </li>
        </ul>
    </div>
</div>

<textarea name="calendar_value" id="calendar_value" class="hide">{{ json_encode($defaultData ?? new stdClass()) }}</textarea>

<script>
    window.calendarConfig = {
        justView: {{ (int)$isJustView }}
    };
</script>
