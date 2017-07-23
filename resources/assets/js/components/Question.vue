<template lang="html">
<div class="col-md-12">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><b>{{ liveQuestion.body }}</b></h4></div>

            <div class="panel-body">
                <div v-if="liveQuestion.isMultiple" >
                    <!-- Multiple choice options -->
                    <multiple :liveQuestion='liveQuestion'></multiple>    
                </div>
                <div v-else>
                    <!-- Short answer -->
                    <short :liveQuestion='liveQuestion'></short>   
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h4> 00:00 </h4></div>

            <div class="panel-body">
                <h2> Leaderboard </h2>
            </div>
        </div>
    </div>
</div>

</template>

<script>
    export default {

        props: ['questions'],

        computed: {
            // Question to answer NOW.... needs to change
            liveQuestion: function () {
                //here the question that is live should be returned
                if ( this.questions != null ) {
                    return this.questions[1]
                }

                return [];
            }
        },

    }
</script>

<style lang="css">
</style>