<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm" v-if="reports.length > 0">
            <thead>
            <tr>
                <th>#</th>
                <th>Total Hands</th>
                <th>Wins by Player 1</th>
                <th>Wins by Player 2</th>
                <th>Created at</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(report) in reports">
                    <td>{{report.id}}</td>
                    <td>{{report.total_hands}}</td>
                    <td>{{report.player_1_wins}}</td>
                    <td>{{report.player_2_wins}}</td>
                    <td>{{report.created_at}}</td>
                </tr>
            </tbody>
        </table>
        <div v-else><h1>No Reports, please upload a file with poker hands!</h1></div>
    </div>
</template>

<script type="text/javascript">

    export default
    {
        name: "ReportsComponent",

        props:['reports'],

        mounted()
        {
            // console.log(this.reports);
        },

        methods:{
        },
    }
</script>
