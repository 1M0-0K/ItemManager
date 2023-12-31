<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Item Manager</title>
		<link rel="stylesheet" href="css/fonts.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

	<div id="container">

		<main>

			<header>
			
				<h1>Items</h1>
				<p class="logout">
					LogOut
				</p>
			
			</header>

			<div class="search_filters">

				<form action="">
					Search for
					<input id="search" type="text" placeholder="Sword">
					in

					<select id="" name="search-field">
						<option value="id">ID</option>
						<option value="name" selected="selected">Name</option>
						<option value="owner">Players</option>
						<option value="type">Type</option>
					</select>

					Order by:
					<select id="sort" name="orderby">
						<option value="id" selected="selected">ID</option>
						<option value="locale_name">Name</option>
						<option value="att">Attribute0</option>
						<option value="mag">Attribute1</option>
					</select>
					<button id="submit">
						<svg viewBox="0 0 24 24" width="24" height="24">
							<use xlink:href="#svg-search"></use>
						</svg>
					</button>
					<button class="refresh">
						<svg viewBox="0 0 24 24" width="24" height="24">
							<use xlink:href="#svg-refresh"></use>
						</svg>
					</button>
				</form>
				<p class="error search-error"></p>

			</div>

			<div class="data_list">

				<table border="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Player</th>
							<th>Type</th>
							<th>Position</th>
							<th>Amount</th>
							<th>Attribute0</th>
							<th>Attribute1</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

				<div class="pages">
					<ul>
						<li class="arrow left">
							<svg viewBox="0 0 24 24" width="24" height="24">
								<use xlink:href="#svg-left"></use>
							</svg>
						</li>
						<li class="arrow right">
							<svg viewBox="0 0 24 24" width="24" height="24">
								<use xlink:href="#svg-right"></use>
							</svg>
						</li>
					</ul>
				</div>

			</div>

		</main>

	</div>

		<!--SVG List-->
		<svg width="0" height="0" style="display:none;"> 
		    <defs>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-grid">
			    <path
				d="M3 11h8V3H3m0 18h8v-8H3m10 8h8v-8h-8m0-10v8h8V3"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-players">
			    <path
				d="M16 17v2H2v-2s0-4 7-4 7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.39 3.39 0 0 0-1.93.59 5 5 0 0 1 0 5.82A3.39 3.39 0 0 0 15 11a3.5 3.5 0 0 0 0-7z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-account">
			    <path
				d="M12 4a4 4 0 1 1 0 8 4 4 0 1 1 0-8m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-logo">
			    <path
				d="M21 16.5a.99.99 0 0 1-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18s-.41-.06-.57-.18l-7.9-4.44A.99.99 0 0 1 3 16.5v-9a.99.99 0 0 1 .53-.88l7.9-4.44c.16-.12.36-.18.57-.18s.41.06.57.18l7.9 4.44a.99.99 0 0 1 .53.88v9M12 4.15l-1.89 1.07L16 8.61l1.96-1.11L12 4.15M6.04 7.5L12 10.85l1.96-1.1-5.88-3.4L6.04 7.5M5 15.91l6 3.38v-6.71L5 9.21v6.7m14 0v-6.7l-6 3.37v6.71l6-3.38z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-edit">
			    <path
				d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83 3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75L3 17.25z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-delete">
			    <path
				d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-left">
			    <path
				d="M15.41 16.58L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.42z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-right">
			    <path
				d="M8.59 16.58L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.42z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-logout">
			    <path
				d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-search">
			    <path
				d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5-1.5 1.5-5-5v-.79l-.27-.27C12.59 15.41 11.11 16 9.5 16a6.5 6.5 0 1 1 0-13m0 2A4.48 4.48 0 0 0 5 9.5 4.48 4.48 0 0 0 9.5 14 4.48 4.48 0 0 0 14 9.5 4.48 4.48 0 0 0 9.5 5z"
			    fill="currentColor"/>
			</symbol>
			<symbol width="24" height="24" viewBox="0 0 24 24" fill="none" id="svg-refresh">
			    <path
				d="M17.65 6.35C16.2 4.9 14.21 4 12 4a8 8 0 1 0 0 16c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18a6 6 0 1 1 0-12c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"
			    fill="currentColor"/>
			</symbol>
		    </defs>
		</svg>

		<script src="jscript/jscript.js"></script>
	</body>
</html>
