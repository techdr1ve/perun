		body {
			background-color: #96c193;
		}
		
		#more {display: none;}

		p {
		  font-size: 25px;
		}

		.thumbnail:hover {
			position:relative;
			right:-50px;
			bottom:0px;
			width:150px;
			height:auto;
			display:inline;
			z-index:999;			
		}

		.thumbnail2:hover {
			position:relative;
			right:-10px;
			bottom:0px;
			width:150px;
			height:auto;
			display:inline;
			z-index:999;			
		}
		
		.thumbnail3:hover {
			position:relative;
			right:-10px;
			bottom:0px;
			width:150px;
			height:auto;
			display:inline;
			z-index:999;			
		}		

		.thumbnail4{
		  width:300px;
		  position:relative;
		}

		.thumbnail4 img{
		  max-width:100%;
		}

		.thumbnail4 h1{
		  position:relative;
		  top:50%;
		  left:0;
		  color:lightgrey;
		  width:100%;
		  text-align:center;
		  transform:translateY(-50%); /* doesn't work in IE9 and older I'm affraid */
		  margin:0;
		}

		#btnControl {
			display: none;
		}

		#btnControl:checked + label > img {
			width: 70px;
			height: 74px;
		}

		h1,h2,h3,h4,h5 {
			color: black; 		
		}

		ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
		}

		li {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
		}

		li {
		  float: left;
		  border-right:1px solid #bbb;

		}

		li:last-child {
		  border-right: none;
		}

		li a, .dropbtn {
		  display: inline-block;
		  color: white;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		li a:hover, .dropdown:hover .dropbtn {
		  background-color: green;
		}


		li.dropdown {
		  display: inline-block;
		}


		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #333;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		.dropdown-content a {
		  color: white;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		  text-align: left;
		}

		.dropdown-content a:hover {background-color: #008000;}

		.dropdown:hover .dropdown-content {
		  display: block;
		}

		
		#header{
			border-top: 1px solid navy;
			border-bottom: 1px solid navy;
			padding: 10px 0 10px 0px;

		}
		
		#content{
			border-top: 1px solid navy;
			border-bottom: 1px solid navy;
			padding: 10px 0 10px 0px;
		}
		
		#footer{
			padding: 10px 0 10px 0px;
			text-align: right;
		}
		
		table, td{
			border: 1px solid black;
			background-color:#ffffe6
			
		}
		
		#myTable tr.header, #myTable tr:hover {
		  background-color: #f1f1f1;
		}
		
		table{
			position: relative;
			border-collapse: collapse;
			counter-reset: tableCount;  			
		}

		.counterCell:before {              
			content: counter(tableCount); 
			counter-increment: tableCount; 
		}

		
		table, th{
			border: 1px solid black;
			background-color:#d9d9d9;
			position: sticky;
			cursor: pointer;
			top: 0;		
		}
		
		img:hover {
		  animation: shake 0.5s;
		  animation-iteration-count: infinite;
		}

		@keyframes shake {
		  0% { transform: translate(1px, 1px) rotate(0deg); }
		  10% { transform: translate(-1px, -2px) rotate(-1deg); }
		  20% { transform: translate(-3px, 0px) rotate(1deg); }
		  30% { transform: translate(3px, 2px) rotate(0deg); }
		  40% { transform: translate(1px, -1px) rotate(1deg); }
		  50% { transform: translate(-1px, 2px) rotate(-1deg); }
		  60% { transform: translate(-3px, 1px) rotate(0deg); }
		  70% { transform: translate(3px, 1px) rotate(-1deg); }
		  80% { transform: translate(-1px, -1px) rotate(1deg); }
		  90% { transform: translate(1px, 2px) rotate(0deg); }
		  100% { transform: translate(1px, -2px) rotate(-1deg); }
		}
		
	

		.tooltip {
		  position: relative;
		  display: inline-block;
		  border-bottom: 0px dotted black;
		}

		.tooltip .tooltiptext {
		  visibility: hidden;
		  width: 120px;
		  background-color: black;
		  color: #fff;
		  text-align: center;
		  border-radius: 6px;
		  padding: 5px 0;
		  
		  /* Position the tooltip */
		  position: absolute;
		  z-index: 1;
		  top: 100%;
		  left: 50%;
		  margin-left: -60px;
		}

		.tooltip:hover .tooltiptext {
		  visibility: visible;
		}

		* {
		  box-sizing: border-box;
		}

		#myInput {
		  background-image: url('/css/searchicon.png');
		  background-position: 10px 10px;
		  background-repeat: no-repeat;
		  width: 10%;
		  font-size: 14px;
		  padding: 2px 10px 2px 10px;
		  border: 1px solid #000000;
		  margin-bottom: 6px;
		}

		#myTable {
		  border-collapse: collapse;
		  width: 100%;
		  border: 1px solid #ddd;
		  font-size: 16px;	  
		}

		#myTable th, #myTable td {
		  text-align: center;
		  padding: 1px;
		}

		#myTable tr {
		  border-bottom: 1px solid #ddd;
		}




		#myznput1 {
		  background-image: url('/css/searchicon.png');
		  background-position: 10px 10px;
		  background-repeat: no-repeat;
		  width: 10%;
		  font-size: 14px;
		  padding: 2px 10px 2px 10px;
		  border: 1px solid #000000;
		  margin-bottom: 6px;
		}

		#myzable1 {
		  border-collapse: collapse;
		  width: 100%;
		  border: 1px solid #ddd;
		  font-size: 16px;
		}

		#myzable1 th, #myTable td {
		  text-align: center;
		  padding: 1px;
		}

		#myzable1 tr {
		  border-bottom: 1px solid #ddd;
		}

		#myzable1 tr.header, #myTable tr:hover {
		  background-color: #f1f1f1;
		}
