<!DOCTYPE HTML>
<html lang="ru">
<head>
    <!-- META -->
    <title>SkyNet Test</title>
    <meta charset="utf-8">
    <meta name="author" content="Дмитрий Жиляев">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/my.css">
</head>
<body>
<br>
<header class="container">
	<h1>SkyNet Тарифы</h1>
	<hr>
	<?php
	$file = "api/data.json";
	if(!file_exists($file)){
		$json = file_get_contents('http://sknt.ru/job/frontend/data.json');
		file_put_contents($file, $json);
	}
	?>
</header>
<section class="container" id="app" >
	<router-view></router-view>
</section>
<hr>
<footer class="container">
    <div class="row justify-content-center">
        <i class="material-icons" style="font-size: 100px;">code</i>
        <div>
            <br>
            <h5>© 2017. All rights reserved</h5>
            <iframe align="center" class="justify-content-center" src="https://ghbtns.com/github-btn.html?user=zhilyaev&type=follow&size=large" frameborder="0" scrolling="0" width="177px" height="30px"></iframe>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
<script type="text/x-template" id="step1">
	<div class="row justify-content-end d-flex">
		<div v-for="plan in plans" class="card col col-12 col-sm-12 col-md-6 col-lg-4">
			<h4 class="card-header">Тариф "{{plan.title}}"
				<span class="badge badge-success">{{plan.speed}} Мбит/с</span>
			</h4>
			<div class="card-body">
				<b>350 - 480 Р/мес</b>
				<i class="material-icons float-right">play_arrow</i>
				<ul>
					<li v-for="option in plan.free_options">{{option}}</li>
				</ul>
				<hr>
				<a href="http://www.sknt.ru/tarifi_internet/in/1.htm">Узнать подробнее на сайте</a>
			</div>
		</div>
	</div>
</script>
<script type="text/x-template" id="step2">
	<h1>Шаг2 </h1>
</script>
<script type="text/x-template" id="step3">
	<h1>Шаг3 {{ message }}</h1>
</script>
<script>
	/* smth like func main */
    let app; // Для управления из консоли
    $.getJSON( "api/data.json", function( json ) {
	    let plans = json.tarifs;
        const index = {
            template : "#step1",
            props: ['plans']
        };

        const tarif = {
            template : "#step2",
           // props: ['plans']
        };

        const pay = {
            template : "#step3",
            props: ['message']
        };

        const vueRouter = new VueRouter({
            routes: [
                { path:"/", component:index, props:{plans:plans} },
                { path:"/:id", component:tarif },
                { path:"/:id/pay", component:pay,  props: {message:'Пари',default:true} }
            ]
        });

	    app = new Vue({
		    el:"#app",
            router: vueRouter ,
	        data: {plans}
        })

    });
</script>
</body>
</html>