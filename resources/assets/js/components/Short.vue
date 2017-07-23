<template lang="html">

	<div class="short">
		<!-- FORM TO ANSWER SHORT QUESTION -->
	    <form method="Post" action="/live/response" @submit.prevent="onSubmit">
	    	<div class="control">
	    		<label for="answer">Enter your answer:</label>
	    		<input type="text" id="answer" name="answer" class="input" v-model="answer"/>
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

