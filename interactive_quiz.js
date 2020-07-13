// interactive quiz
var interactiveQuiz[
	{ 
	//multiple choice
		question: "Who is the strongest?",
		answers: {
		a: "Captain Marvel",
		b: "Thor",
		c: "Superman",
		d: "Luigi, obviously"
		},
		correctAnswer: 'd'
	},
	{
	//multiple choice
		question: ""
		answers: {
			a: ""
			b: ""
			c: ""
			d: ""
		},
		correctAnswer: 'b'
	},
	{
	//multiple choice
		question: ""
		answers: {
			a: ""
			b: ""
			c: ""
			d: ""
		},
		correctAnswer: 'c'
	},
	{
	//true or false 
		question: "True or False: Goldfish only have a memory of three seconds"
		answers: {
			a: "True"
			b: "False"
		},
		correctAnswer: 'b'
	},
	{
	//true or false
		question: "True or False: About five percent of the body of a jellyfish is solid matter, the rest is water"
		answers: {
			a: "False"
			b: "True"
		},
		correctAnswer: 'a'
	}/*,
	{
	// fill-in-the-blank
		question: "The capital of Palestine is <input type=""text"" id=""input1"" size=""15""/><text class=""button2"" id=""check1""></text>" 
					", and the capital of Jordan is <input type=""text"" id=""input2"" size=""15""/><text class=""button2"" id=""check2""></text> "
		answers: {
			a: input1.value
			b: input2.value
		},
		correctAnswer: ''
	}*/
];

var quizForm = document.getElementById('quiz');
var UserResults = document.getElementById('results');
var submitButton = document.getElementById('submit');
var resetButton = document.getElementById('reset');

generatingQuiz(interactiveQuiz, quizForm, UserResults, submitButton, restButton);

// add reset button??
function generatingQuiz(questions, quizForm, UserResults, submitButton){
	function showQuestions(questions, quizForm)
	{
		//storing output and answer choices
		var output = [];
		var answers;
		
		//for each question 
		for(var i=0; i < questions.length; i++)
		{
			//first reset the list of answers
			answers = [];
			
			//for each available answer
			for(letter in questions[i].answers)
			{
				//answers.push(questions[i].answers[letter]);
				answers.push('<label>' + '<input type="radio" name="question' +i+'" value="'+letter+'">' + letter + ': ' + questions[i].answers[letter] + '</label>');
			}
			//adding this question and its answers to the ouput
			output.push('<div class="question">' + questions[i].question + '<div class="answers">' + answers.join('') + '</div>');
		}
		//combining output list into one string of html and put it on the page
		quizForm.innerHTML = output.join('');
	}
	
	function showResults(questions, quizForm, UserResults)
	{
		//gathering answers from quiz
		var answerResults = quiz.querySelectorAll('.answers');
		
		//keeping track of user's answers
		var userInput = '';
		var numCorrect = 0;
		
		//for each question
		for(var i = 0; i < questions.length; i++)
		{
			//find selected answer
			userInput = (answerResults[i].querySelector
		('input[name=question'+i+']:checked')||{}).value;
		
			//if answer is correctAnswer
			if(userInput == questions[i].correctAnswer)
			{
				numCorrect++; 
				// answers correct coloring in green
				answerResults[i].style.color = 'green'; 
			}
			else
			{
				answerResults[i]; 
				// answers wrong coloring in red
				answerResults[i].style.color = 'red'; 
			}
		}
		UserResults.innerHTML = numCorrect + 'out of' + questions.length;
	}
	//show questions right away
	showQuestions(questions, quizForm);
	
	// on submit, show results
	submitButton.onclick = function(){
		showResults(questions, quizForm, UserResults);
	}
	
	resetButton.onclick = function(){
		generatingQuiz(interactiveQuiz, quizForm, UserResults, submitButton); //add resetButton??
	}
}