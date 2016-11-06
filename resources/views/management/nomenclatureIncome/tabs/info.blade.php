<div class="info info-compact">
    <table class="table table-striped-on-hover">
        <tr>
           <td width="200">Договор:</td>
           <td>
               {{ $income->agreement->from }} -
               {{ $income->agreement->until }}
               ({{ $income->agreement->price }})
           </td>
        </tr>
        <tr>
           <td width="200">Контрагент:</td>
           <td>{{ $income->contractor }}</td>
        </tr>
        <tr>
           <td width="200">Источник финансирования:</td>
           <td>{{ $income->sourceOfFinancing }}</td>
        </tr>
        <tr>
           <td width="200">Склад</td>
           <td>{{ $income->storage }}</td>
        </tr>
        <tr>
           <td width="200">Выполнил:</td>
           <td>{{ $income->createdBy->fullName() }}</td>
        </tr>
        <tr>
           <td width="200">Дата выполнения:</td>
           <td>{{ $income->createdAt }}</td>
        </tr>
    </table>
</div>