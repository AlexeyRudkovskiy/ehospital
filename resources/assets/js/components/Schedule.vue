<template>
    <div v-for="item in items" style="border-bottom: 1px solid rgba(0, 0, 0, .1); padding-top: 10px; padding-bottom: 10px;">
        <input type="number" name="schedule[{{$index}}][day_of_week]" placeholder="Day of week(from 1 to 7)" />
        <br>
        <input type="time" name="schedule[{{$index}}][from]" placeholder="Work from:" />
        <br>
        <input type="time" name="schedule[{{$index}}][to]" placeholder="Work to:" />
        <br>
        <input type="time" name="schedule[{{$index}}][per_patient]" placeholder="Per patient:" />
        <br>
        <input type="button" class="btn btn-danger btn-small" value="delete" v-on:click="deleteItem($index)" />
    </div>

    <div>
        <input type="button" class="btn btn-default" value="Insert new" v-on:click="insertItem" />
    </div>
</template>

<script>

    export default{
        data() {
            return {
                'items': [ ]
            };
        }, methods: {
            insertItem: function () {
                this.items.push({});
            }, deleteItem: function (index) {
                this.items.splice(index, 1);
            }
        }
    }
</script>