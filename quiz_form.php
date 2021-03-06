<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

	function creating_quiz()
	{
		if ( (! array_key_exists("username", $_POST)) or
         (! array_key_exists("password", $_POST)) or
         ($_POST["username"] == "") or
         ($_POST["password"] == "") or
         (! isset($_POST["username"])) or
         (! isset($_POST["password"])) )
		{
			destroy_and_exit("must enter a username and password!");
		}
		
		$username = strip_tags($_POST["username"]);
		$password = $_POST["password"];
		
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		
		$conn = hsu_conn_sess($username, $password);
		
		$quiz_question = "select id, question
							from question_table";
		$question_query = oci_parse($conn, $quiz_question);
		oci_execute($question_query);
		?>
		<form id="mainFrame" method="get" action="<?=htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
			<div id="colorFrame">
				<?php
					while(oci_fetch($question_query))
					{
						$current_question = oci_result($question_query, "");
						$current_answer = oci_result($question_query, "");
						?>
				<script type="text/javascript"> 
					var interactiveQuiz = [
						{//multiple choice questions
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
							question: "Where is Waldo really?",
							answers: {
							a: "Antarctica",
							b: "Exploring the Pacific Ocean",
							c: "Sitting on a tree",
							d: "Minding his own business"
						  },
						  correctAnswer: 'd'
						},
						{
							question: "What is the most used letter in the english language ?",
							answers: {
							a: "A",
							b: "E",
							c: "I",
							d: "O",
							e: "U"
						  },
						  correctAnswer: 'b'
						},
						{//true or false questions
							question: "True/False: About five percent of the body of a jellyfish is solid matter, the rest is water",
							answers: {
							a: "True",
							b: "False",
						  },
						  correctAnswer: 'a'
						},
						{
							question: "True/False: Goldfish only have a memory of three seconds",
							answers: {
							a: "True",
							b: "False",
						  },
						  correctAnswer: 'b'
						}
					];
					
					var quizForm = document.getElementById('quiz');
					var resultsForm = document.getElementById('results');
					var submitButton = document.getElementById('submit');
					var resetButton = document.getElementById('reset');
					
					generatingQuiz(interactiveQuiz, quizForm, resultsForm, submitButton);
					
					function generatingQuiz(questions, quizForm, resultsForm, submitButton){

						function showQuestions(questions, quizForm){
							//storing the output and the answer choices
							var output = [];
							var answers;

							// for each question
							for(var i=0; i<questions.length; i++){
								
								// first reset the list of answers
								answers = [];

								// for each available answer
								for(letter in questions[i].answers){

									//adding an html radio button
									answers.push(
										'<label>'
											+ '<input type="radio" name="question'+i+'" value="'+letter+'">'
											+ letter + ': '
											+ questions[i].answers[letter]
										+ '</label>'
									);
								}

								// adding this question and its answers to the output
								output.push(
									'<div class="question">' + questions[i].question + '</div>'
									+ '<div class="answers">' + answers.join('') + '</div>'
								);
							}
							

							// combining output list into one string of html and put it on the page
							quizForm.innerHTML = output.join('');
						}


						function showResults(questions, quizForm, resultsForm){
							
							// gathering answers from quiz
							var answerResults = quizForm.querySelectorAll('.answers');
							
							// keeping track of user's answers
							var userAnswer = '';
							var numCorrect = 0;
							
							// for each question
							for(var i=0; i<questions.length; i++){

								// find selected answer
								userAnswer = (answerResults[i].querySelector('input[name=question'+i+']:checked')||{}).value;
								
								// if answer is correct
								if(userAnswer===questions[i].correctAnswer){
									// add to the number of correct answers
									numCorrect++;
									
									// coloring the answers green
									answerResults[i].style.color = 'green';
								}
								// if answer is wrong or blank
								else{
									// coloring the answers red
									answerResults[i].style.color = 'red';
								}
							}

							// show number of correct answers out of total
							resultsForm.innerHTML = numCorrect + ' out of ' + questions.length;
						}

						// show questions right away
						showQuestions(questions, quizForm);
						
						// on submit, show results
						submitButton.onclick = function(){
							showResults(questions, quizForm, resultsForm);
						}

						resetButton.onclick = function()
						{
							generatingQuiz(interactiveQuiz, quizForm, resultsForm, submitButton);
						}
					}	
				
				</script> 
						<?php
					} ?>
				<div id="quiz"></div>
				<div id="results"></div>
				<button id="submit" value="submitted"> Enter </button>
				<button id="reset"> Reset </button>
			</div>
		</form><?php
		oci_free_statement($question_query);
		oci_close($conn);
	}
	
?>