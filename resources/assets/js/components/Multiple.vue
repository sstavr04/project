<template lang="html">

	<div class="multiple">
		<!-- FORM TO ANSWER Multiple choice QUESTION -->
	    <form method="Post" action="/live/response" @submit.prevent="onSubmit">
	    	
	    	<label>Choose your answer:</label>
	    	<div align="left" v-for="multiple in liveQuestion.multiple"><br>
	    		<label>
    				<input type="radio" name="group1" :value="multiple.answer" v-model="answer">{{multiple.answer}}
				</label>
		    </div>


	    	<div class="control">
	    		<button class="btn btn-primary">Submit</button>
	    	</div>

	    </form>

	</div>
       
    

</template>

<script>
    export default {
        props: ['liveQuestion'],
        data(){
        	return{
        		answer:'',
        		question_id:''
        	}
        },

        methods: {
        	//submit answer to DB
        	onSubmit() {
            	//presist to server
            	this.question_id=this.liveQuestion.id;
            	axios.post('/live/response',{
            		answer: this.answer,
            		question_id: this.question_id
            	}).then(response=>alert('success'));
        	},

        }
        
    }
</script>

<style lang="css">
</style>