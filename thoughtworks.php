<?php
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>
<head>
	<title>ThoughtWorks</title>
</head>
<body>
	<h1>ThoughtWorks Task</h1>
	
	<button class="get-next-task">Get Next Task</button>
	<br><br>
	<button class="task1">Task 1</button>
	<button class="task2">Task 2</button>
	<button class="task3">Task 3</button>
	<button class="task4">Task 4</button>

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(e){
			$('.get-next-task').click(function(e){
				getNextTask();				
			});
			$('.task1').click(function(e){
				task1();
			});
			$('.task2').click(function(e){
				task2();
			});
			$('.task3').click(function(e){
				task3();
			});
			$('.task4').click(function(e){
				task4();
			});
		});

		function getNextTask(){
			$.ajax({
				type: "GET",
		        url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge",
				headers : {'userId': 'SyqB2rS_f'},
		        success: function(data){
		        	if(data){
		        		console.log(data);
		        	}
		        }
		     });
		}

		function task1(){
		    $.ajax({
				type: "GET",
		        url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/input",
				headers : {'userId': 'SyqB2rS_f'},
		        success: function(data){
		        	if(data){
		        		
		        		var result = {
		        			"output": {
		        				'count': data.length
		        			}
		        		};

						$.ajax({
							type: "POST",
							url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/output",
							dataType: 'json',
							headers : {
								'userId': 'SyqB2rS_f',
								'Content-Type': 'application/json'
							},
							data: JSON.stringify(result),
							success: function(response){
								console.log(response);
							}
						});
		        	}
		        }
		    });
		}

		function task2(){
		    $.ajax({
				type: "GET",
		        url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/input",
				headers : {'userId': 'SyqB2rS_f'},
		        success: function(data){
		        	if(data){
		        		var activeProducts = 0;

		        		var date = new Date();
		        		var dateStr = date.getFullYear() + '-' + ('0' + eval(date.getMonth()+1)).substr(-2,2) + '-' + ('0'+date.getDate()).substr(-2,2);
		        		var currentDate = new Date(dateStr);
		        		
		        		$.each(data, function (index, value) {
		        			if(value.startDate){
		        				if(new Date(value.startDate) <= currentDate){
		        					if(!value.endDate){
		        						activeProducts++;
		        					} else {
		        						if(new Date(value.endDate) >=currentDate){
		        							activeProducts++;
		        						}
		        					}
		        				}
		        			}
						});
		        		
		        		var result = {
		        			"output": {
		        				'count': activeProducts
		        			}
		        		};

						$.ajax({
							type: "POST",
							url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/output",
							dataType: 'json',
							headers : {
								'userId': 'SyqB2rS_f',
								'Content-Type': 'application/json'
							},
							data: JSON.stringify(result),
							success: function(response){
								console.log(response);
							}
						});
		        	}
		        }
		    });
		}

		function task3(){
		    $.ajax({
				type: "GET",
		        url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/input",
				headers : {'userId': 'SyqB2rS_f'},
		        success: function(data){
		        	if(data){
		        		var category = [];
		        		var count = [];

		        		var date = new Date();
		        		var dateStr = date.getFullYear() + '-' + ('0' + eval(date.getMonth()+1)).substr(-2,2) + '-' + ('0'+date.getDate()).substr(-2,2);
		        		var currentDate = new Date(dateStr);
		        		
		        		$.each(data, function (index, value) {
		        			if(value.startDate){
		        				if(new Date(value.startDate) <= currentDate){
		        					if(!value.endDate){
		        						if(category.indexOf(value.category) != -1){
		        							count[category.indexOf(value.category)]++;
		        						} else {
		        							category.push(value.category);
		        							count[category.indexOf(value.category)] = 1;
		        						}
		        					} else {
		        						if(new Date(value.endDate) >= currentDate){
		        							if(category.indexOf(value.category) != -1){
			        							count[category.indexOf(value.category)]++;
			        						} else {
			        							category.push(value.category);
			        							count[category.indexOf(value.category)] = 1;
			        						}
		        						}
		        					}
		        				}
		        			}
						});

		        		var result = {
		        			"output": {}
		        		};
    					$.each(category, function (index, value) {
		        			result.output[value] = count[index];
		        		});
		        		
						$.ajax({
							type: "POST",
							url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/output",
							dataType: 'json',
							headers : {
								'userId': 'SyqB2rS_f',
								'Content-Type': 'application/json'
							},
							data: JSON.stringify(result),
							success: function(response){
								console.log(response);
							}
						});
		        	}
		        }
		    });
		}

		function task4(){
		    $.ajax({
				type: "GET",
		        url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/input",
				headers : {'userId': 'SyqB2rS_f'},
		        success: function(data){
		        	if(data){
		        		var totalPrice = 0

		        		var date = new Date();
		        		var dateStr = date.getFullYear() + '-' + ('0' + eval(date.getMonth()+1)).substr(-2,2) + '-' + ('0'+date.getDate()).substr(-2,2);
		        		var currentDate = new Date(dateStr);
		        		
		        		$.each(data, function (index, value) {
		        			if(value.startDate){
		        				if(new Date(value.startDate) <= currentDate){
		        					if(!value.endDate){
		        						totalPrice += value.price;
		        					} else {
		        						if(new Date(value.endDate) >= currentDate){
		        							totalPrice += value.price;
		        						}
		        					}
		        				}
		        			}
						});
		        		
		        		var result = {
		        			"output": {
		        				'totalValue': totalPrice
		        			}
		        		};
    		    		
						$.ajax({
							type: "POST",
							url: "http://tw-http-hunt-api-1062625224.us-east-2.elb.amazonaws.com/challenge/output",
							dataType: 'json',
							headers : {
								'userId': 'SyqB2rS_f',
								'Content-Type': 'application/json'
							},
							data: JSON.stringify(result),
							success: function(response){
								console.log(response);
							}
						});
		        	}
		        }
		    });
		}

	</script>
</body>
</html>