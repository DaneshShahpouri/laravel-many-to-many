<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="showroom">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-md" id="navbar">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.home') }}">
                    <div class="logo_laravel">DS</div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{route('admin.projects.index')}}" class="nav-link" type="button">Progetti</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.types.index')}}" class="nav-link" type="button">Tipologie</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.technologies.index')}}" class="nav-link" type="button">Tecnoloigie</a>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                </div>

            </div>
        </nav>

        {{-- main --}}
        <div class="_container-wrapper">
            {{-- minicounter --}}
            <div class="counter-box hidden d-flex justify-content-center align-item-center" id="mini-counter"></div>
            {{-- Counter --}}
            <div class="counter-box d-flex justify-content-center align-item-center" id="counter"></div>
            

            <div class="__container p-pre" id="container-pre"></div>

            <div class="__container p-center" id="container-1"></div>
            
            <div class="__container p-post" id="container-post"></div>
            
            <div class="__container p-left" id="container-left">
                <h1>contenuto sinistra</h1>
            </div>

            <div class="__container p-right" id="container-right">
                <h1>contenuto destra</h1>
            </div>

            {{-- Background --}}
            <div class="background" id="background">
                <div class="background layout-black bg-dark" id="layout"></div>
                <div class="cerchio hidden top-showroom" id="cerchio-top-hidden"></div>
                <div class="cerchio hidden bottom-showroom" id="cerchio-bottom-hidden"></div>
                <div class="cerchio top-showroom" id="cerchio-top"></div>
                <div class="cerchio bottom-showroom" id="cerchio-bottom"></div>
            </div>

        </div>
    </div>



    <script>
        //------------------------------
        // Dati di configurazione
        //------------------------------

        //Scrollable
        let MainScrollableEl = document.getElementById('container-1')
        let TopScrollableEl = document.getElementById('container-pre')
        let BottomScrollableEl = document.getElementById('container-post')
        let LeftScrollableEl = document.getElementById('container-left')
        let RightScrollableEl = document.getElementById('container-right')

        //navbar
        let navbar = document.getElementById('navbar')

        //contatorigrafici
        let indexBox=document.getElementById('counter')
        let miniIndexBox=document.getElementById('mini-counter')

        //
        
        //VariabiliGlobali
        let isAnimated = false;

        //Titolo della pagina | Descrizione | isSlideble | se si: array di pagine del progetto scrollorizzontale 
        let confArray = [
            ['showroom', 'Sezione della pagina dedicata alla presentazione', false],
            ['projects', 'Qui di seguito troverai i vari progetti e potrai approfondirne i dettagli', false],
            ['projects', "Questo Progetto è una prova incosistente, rappresentazione della manchevolezza uamna, il vuoto come presenza fissa, l'incosistenza dell'esperire umano. Cancellami.", true, ['Progetto di prova esempio', 'https://sitiwebfox.it/images/realizzazione-siti-web-professionali.png', 'https://kinsta.com/it/wp-content/uploads/sites/2/2020/02/migliori-pratiche-di-web-design-1024x512.jpg'], '#FF5154'],
            ['projects', 'Progetto2 di prova con elementi specifici per verede che succede se metto info lunghe che sembrano volere dire  qualcosa.', true, ['Prova due - prova', 'https://kinsta.com/it/wp-content/uploads/sites/2/2021/09/how-to-translate-a-website-1024x512.jpeg', 'https://www.ionos.it/digitalguide/fileadmin/DigitalGuide/Teaser/web-apps-t.jpg','https://www.raiscuola.rai.it/cropgd/1900x1069/dl/img/2021/02/09/1612868746079_monitor-1307227_1920.jpg' ,'https://files.spazioweb.it/32/3d/323d8cfb-176d-4c90-9ba9-a4fe6eab5d58.jpeg'], '#5E2A40'],
            ['contacts', 'sezione dedicata ai contatti', false],
            ['extra', 'qui puoi vedere progetti extra', false]
        ]
        
        //contatori logici
        let contatoreOrizzontale = 0;
        let contatore = 0;
        let precontatore = confArray.length - 1;
        let postcontatore = 1;

        //------------------------------
        // /Dati di configurazione
        //------------------------------

        //Scroll Verticale
        // Dal centro al basso
        function scrollElCenterDown(elemento) {

            elemento.classList.add('move-center-top');
            let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-center-top');

            }, 2200);

        }
        // Dal centro al alto
        function scrollElCenterUp(elemento) {

            elemento.classList.add('move-center-bottom');
            let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-center-bottom');

            }, 2200);
        }
        //Dall alto al centro
        function scrollElTopCenter(elemento) {
            elemento.style = 'display:block';
            elemento.classList.add('move-top-center');
            let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-top-center');
            }, 2200);
        }
        //Dall basso al centro
        function scrollElBottomCenter(elemento) {
            elemento.classList.add('move-bottom-center');
            let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-bottom-center');
            }, 2200);

        }
        //Scroll Orizzontale
        // Dal centro a sinistra
        function scrollElCenterLeft(elemento) {

            elemento.classList.add('move-center-left');
                let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-center-left');

            }, 2200);

        }

         // Dal centro a destra
        function scrollElCenterRight(elemento) {

            elemento.classList.add('move-center-right');
                let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-center-right');

            }, 2200);

        }
        
        // Dal  destra a centro
        function scrollElRightCenter(elemento) {

            elemento.classList.add('move-right-center');
                let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-right-center');

            }, 2200);

        }

        // Dal  destra a centro
        function scrollElLeftCenter(elemento) {

            elemento.classList.add('move-left-center');
                let disbandClass = setTimeout(() => {
                elemento.classList.remove('move-left-center');

            }, 2200);

        }
        
        

        /** Crea degli elementi con classe e li aggiunge all'elemento padre, il numero è specificabile */
        function createElementAppend(elementoDaCreare, classe, contenuto, elementoGenitore, numeroElementi) {

            for (let i = 0; i < numeroElementi; i++) {

                let newEl = document.createElement(elementoDaCreare);
                newEl.classList.add(classe);
                newEl.innerHTML = contenuto;

                elementoGenitore.append(newEl);

            }
        }

        //creazione Layout
        //Ogni funzione creaContenuto, gestisce l'aspetto e il contenuto del singolo layout scrollabile
        //per mantenere fluide le animazioni ho dovuto separare la logica della creazione per posizione 
        //rispetto allo schermo: Questo Comporta che ogni elemento creato ha dei contenitori con classi 
        //nominate in modo diverso ma che svolgono la stessa funzione, cosi da rendere possibile l'illusione 
        //dello slide.

        // MainSlyde
        function creaContenutoMain(contatore) {
          
            
            //my container - il main
            createElementAppend('div', '_my_container', '', MainScrollableEl, 1);
            let containersMain = document.querySelector('._my_container');
            containersMain.classList.add('d-flex', 'flex-column',  'justify-content-center', 'align-items-center')
            
            //impostare il colore sfondo dei progetti in base a quello dell'arrayconf
            if(confArray[contatore][2]==true){
                containersMain.style="color:white;" 
                containersMain.classList.remove('justify-content-center', 'align-items-center');
                navbar.classList.add("navbar-light");

                miniIndexBox.classList.remove('hidden')
            }
            
            //title - Titolo della pagina
            if(confArray[contatore][2]==true){
                createElementAppend('h1', 'title', confArray[contatore][3][0], containersMain, 1);
            }else{
                createElementAppend('h1', 'title', confArray[contatore][0], containersMain, 1);
            }
           
            let elTitle = document.querySelector("._my_container .title");
            if (!(confArray[contatore][2])){
                elTitle.classList.add('bordo-bianco')
            }
           
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_container-main', confArray[contatore][1], containersMain, 1);
            

                //Se è vero isSlideble allora crea dei bottoni in absolute 
                if (confArray[contatore][2]) {
                createElementAppend('button', 'btn-arrow-left', '<i class="fa-solid fa-caret-left"></i>', containersMain, 1);
                createElementAppend('button', 'btn-arrow-right', '<i class="fa-solid fa-caret-right"></i>', containersMain, 1);
                let btnLeft = document.querySelector('.btn-arrow-left');
                let btnRight = document.querySelector('.btn-arrow-right');
                btnLeft.classList.add('btn',  'rounded-circle')
                btnRight.classList.add('btn',  'rounded-circle')

                btnLeft.addEventListener('click', ()=>{
                    console.log('tasto sinistro, funziona!')
                    scrollLeft();
                })
                btnRight.addEventListener('click', ()=>{
                    console.log('tasto destro, funziona!')
                    scrollRight();
                })
                
                createElementAppend('div', 'row', containersMain, 1)
                
            }
        }

        // TOP
        function creaContenutoTop(contatore) {
            //my containerpre - il main
            createElementAppend('div', '_my_container_pre', '', TopScrollableEl, 1);
            let containersTop = document.querySelector('._my_container_pre');
            containersTop.classList.add('d-flex', 'flex-column', 'justify-content-center', 'align-items-center')

            //impostare il colore sfondo dei progetti in base a quello dell'arrayconf
            if(confArray[contatore][2]==true){
                containersTop.style="color:white;" 
                containersTop.classList.remove('justify-content-center', 'align-items-center');
            }
            //title - Titolo della pagina
            if(confArray[contatore][2]==true){
                createElementAppend('h1', 'title', confArray[contatore][3][0], containersTop, 1);
            }else{
                createElementAppend('h1', 'title', confArray[contatore][0], containersTop, 1);
            }
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_container_main', confArray[contatore][1], containersTop, 1);


            //Se è vero isSlideble allora crea dei bottoni in absolute 
            if (confArray[contatore][2]) {
                createElementAppend('button', 'btn-arrow-left-top', '<i class="fa-solid fa-caret-left"></i>', containersTop, 1);
                createElementAppend('button', 'btn-arrow-right-top', '<i class="fa-solid fa-caret-right"></i>', containersTop, 1);
                let btnLeftTop = document.querySelector('.btn-arrow-left-top');
                let btnRightTop = document.querySelector('.btn-arrow-right-top');
                //console.log(btnRight)
                btnLeftTop.classList.add('btn', 'rounded-circle')
                btnRightTop.classList.add('btn', 'rounded-circle')

                createElementAppend('div', 'row', containersTop, 1)
                
            }
        }

        // BOTTON
        function creaContenutoBottom(contatore) {
            //my containerpre - il main
            createElementAppend('div', '_my_container_post', '', BottomScrollableEl, 1);
            let containersBottom = document.querySelector('._my_container_post');
            containersBottom.classList.add('d-flex', 'flex-column','justify-content-center', 'align-items-center')

            //impostare il colore sfondo dei progetti in base a quello dell'arrayconf
            if(confArray[contatore][2]==true){
                containersBottom.style="color:white;" 
                containersBottom.classList.remove('justify-content-center', 'align-items-center');
            }

             //title - Titolo della pagina
             if(confArray[contatore][2]==true){
                createElementAppend('h1', 'title', confArray[contatore][3][0], containersBottom, 1);
            }else{
                createElementAppend('h1', 'title', confArray[contatore][0], containersBottom, 1);
            }
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_container-main', confArray[contatore][1], containersBottom, 1);
            
            if (confArray[contatore][2]) {
                createElementAppend('button', 'btn-arrow-left-bottom', '<i class="fa-solid fa-caret-left"></i>', containersBottom, 1);
                createElementAppend('button', 'btn-arrow-right-bottom', '<i class="fa-solid fa-caret-right"></i>', containersBottom, 1);
                let btnLeftBottom = document.querySelector('.btn-arrow-left-bottom');
                let btnRightBottom = document.querySelector('.btn-arrow-right-bottom');
                //console.log(btnRight)
                btnLeftBottom.classList.add('btn',  'rounded-circle')
                btnRightBottom.classList.add('btn',  'rounded-circle')

                createElementAppend('div', 'row', containersBottom, 1)
                
            }
        }

        //ContenutoSLideOrizzontali
        // MainOrizzontale
        function creaContenutoMainSlide(contatore, contatoreOrizzontale) {

            //my container - il main
            createElementAppend('div', '_my_container_secondary', '', MainScrollableEl, 1);
            let containersMainSlide = document.querySelector('._my_container_secondary');
            containersMainSlide.style="color:white";
            containersMainSlide.classList.add('d-flex', 'flex-column', 'justify-content-center', 'align-items-center')
            
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_img-wrapper', '', containersMainSlide, 1);
            let imgWrapper= document.querySelector('._my_img-wrapper');
            createElementAppend('img','img', '', imgWrapper, 1)
            let img = document.querySelector("._my_img-wrapper .img");
            img.src = confArray[contatore][3][contatoreOrizzontale] ;
            
            

                //Se è vero isSlideble allora crea dei bottoni in absolute 
                if (confArray[contatore][2]) {
                createElementAppend('button', 'btn-arrow-left', '<i class="fa-solid fa-caret-left"></i>', containersMainSlide, 1);
                createElementAppend('button', 'btn-arrow-right', '<i class="fa-solid fa-caret-right"></i>', containersMainSlide, 1);
                let btnLeft = document.querySelector('.btn-arrow-left');
                let btnRight = document.querySelector('.btn-arrow-right');
                
                btnLeft.classList.add('btn',  'rounded-circle')
                btnRight.classList.add('btn',  'rounded-circle')

                btnLeft.addEventListener('click', ()=>{
                    //console.log('tasto sinistro, funziona!')
                    scrollLeft();
                })
                btnRight.addEventListener('click', ()=>{
                    //console.log('tasto destro, funziona!')
                    scrollRight();
                })  
          }
        }

        //LEFT
        function creaContenutoLeftSlide(contatore, contatoreOrizzontale) {
          if(contatoreOrizzontale==0){
 
            //my container - il main
            createElementAppend('div', '_my_container_left_secondary', '', LeftScrollableEl, 1);
            let containersLeft = document.querySelector('._my_container_left_secondary');
            containersLeft.classList.add('d-flex', 'flex-column',)
            navbar.classList.add("navbar-light");
            containersLeft.style="color:white;" 
           
             //title - Titolo della pagina
             createElementAppend('h1', 'title', confArray[contatore][3][0], containersLeft, 1);
           
           
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_container-main', confArray[contatore][1], containersLeft, 1);
            

                //Se è vero isSlideble allora crea dei bottoni in absolute 
                if (confArray[contatore][2]) {
                createElementAppend('button', 'btn-arrow-left', '<i class="fa-solid fa-caret-left"></i>', containersLeft, 1);
                createElementAppend('button', 'btn-arrow-right', '<i class="fa-solid fa-caret-right"></i>', containersLeft, 1);
                let btnLeft = document.querySelector('.btn-arrow-left');
                let btnRight = document.querySelector('.btn-arrow-right');
                btnLeft.classList.add('btn',  'rounded-circle')
                btnRight.classList.add('btn',  'rounded-circle')

                btnLeft.addEventListener('click', ()=>{
                    console.log('tasto sinistro, funziona!')
                    scrollLeft();
                })
                btnRight.addEventListener('click', ()=>{
                    console.log('tasto destro, funziona!')
                    scrollRight();
                })
                
                createElementAppend('div', 'row', containersLeft, 1)
                
            }
          }else{
              
            //my container - il main
            createElementAppend('div', '_my_container_left_secondary', '', LeftScrollableEl, 1);
            let containersLeft = document.querySelector('._my_container_left_secondary');
            containersLeft.style="color:white";
            containersLeft.classList.add('d-flex', 'flex-column','justify-content-center', 'align-items-center')
           
            //_my_container-main - Body della pagina
            createElementAppend('div', '_my_img-wrapper-left', '', containersLeft, 1);
            let imgWrapperLeft= document.querySelector('._my_img-wrapper-left');
            createElementAppend('img','img', '', imgWrapperLeft, 1)
            let img = document.querySelector("._my_img-wrapper-left .img");
            img.src = confArray[contatore][3][contatoreOrizzontale] ;
            
  
                //Se è vero isSlideble allora crea dei bottoni in absolute 
                if (confArray[contatore][2]) {
                createElementAppend('button', 'left-btn-arrow-left', '<i class="fa-solid fa-caret-left"></i>', containersLeft, 1);
                createElementAppend('button', 'left-btn-arrow-right', '<i class="fa-solid fa-caret-right"></i>', containersLeft, 1);
                let btnLeft = document.querySelector('.left-btn-arrow-left');
                let btnRight = document.querySelector('.left-btn-arrow-right');
                btnLeft.classList.add('btn',  'rounded-circle')
                btnRight.classList.add('btn',  'rounded-circle')
  
                btnLeft.addEventListener('click', ()=>{
                    //console.log('tasto sinistro, funziona!')
                    scrollLeft();
                })
                btnRight.addEventListener('click', ()=>{
                    //console.log('tasto destro, funziona!')
                    scrollRight();
                })
                   
            }

          }
        }

        //RIGHT
        function creaContenutoRightSlide(contatore, contatoreOrizzontale) {
          
            
          //my container - il main
          createElementAppend('div', '_my_container_right_secondary', '', RightScrollableEl, 1);
          let containersRight = document.querySelector('._my_container_right_secondary');
          containersRight.style="color:white";
          containersRight.classList.add('d-flex', 'flex-column',  'justify-content-center', 'align-items-center')
          
         
          //_my_container-main - Body della pagina
          createElementAppend('div', '_my_img-wrapper-right', '', containersRight, 1);
          let imgWrapper= document.querySelector('._my_img-wrapper-right');
          createElementAppend('img','img', '', imgWrapper, 1);
          let img = document.querySelector("._my_img-wrapper-right .img");
            img.src = confArray[contatore][3][contatoreOrizzontale] ;
          
          

              //Se è vero isSlideble allora crea dei bottoni in absolute 
              if (confArray[contatore][2]) {
              createElementAppend('button', 'right-btn-arrow-left', '<i class="fa-solid fa-caret-left"></i>', containersRight, 1);
              createElementAppend('button', 'right-btn-arrow-right', '<i class="fa-solid fa-caret-right"></i>', containersRight, 1);
              let btnLeft = document.querySelector('.right-btn-arrow-left');
              let btnRight = document.querySelector('.right-btn-arrow-right');
              btnLeft.classList.add('btn', 'rounded-circle')
              btnRight.classList.add('btn', 'rounded-circle')

              btnLeft.addEventListener('click', ()=>{
                  //console.log('tasto sinistro, funziona!')
                  scrollLeft();
              })
              btnRight.addEventListener('click', ()=>{
                  //console.log('tasto destro, funziona!')
                  scrollRight();
              })
              
              
          }
        }


        //Background Function
        function backgroundAnimation() {
            let cerchioTop=document.getElementById('cerchio-top')
            let cerchioBottom=document.getElementById('cerchio-bottom')
            let cerchioHiddenTop=document.getElementById('cerchio-top-hidden')
            let cerchioHiddenBottom=document.getElementById('cerchio-bottom-hidden')
            let bg=document.getElementById('background')
            let titles=document.querySelectorAll('.title')

                      
            switch (confArray[contatore][0]) {
                case 'showroom':
                    cerchioTop.style="top:-30%; left:-20%;scale:3;"
                    cerchioBottom.style="bottom:0%; right:0%; scale:2;"
                    break;
                case 'projects':
                    cerchioTop.style="top:-10%; left:10%; scale:2.8;"
                    cerchioBottom.style="bottom:-40%; right:20%; scale:2.4;"
                    break;
                case 'contacts':
                cerchioTop.style="top:-10%; left:10%; scale:2.8;"
                    cerchioBottom.style="bottom:-40%; right:20%; scale:2.4;"
                    break;
                case 'extra':
                    cerchioTop.style="top:-30%; left:50%;scale:2.4;"
                    cerchioBottom.style="bottom:0%; right:40%; scale:2.3;"
                    break;
            }

            if(confArray[contatore][2]==true){
                navbar.classList.add('navbar-dark')
                //Cerchi nascossti
                cerchioHiddenBottom.style="display:block; background-color:rgba(0, 0, 0, 0) ;bottom:-40%; right:20%; scale:2.4;border:1px solid white"
                cerchioHiddenTop.style="display:block; background-color:rgba(0, 0, 0, 0) ;top:-10%; left:10%; scale:2.8; border:1px solid white"
                //---------------

                cerchioTop.style="top:-10%; left:10%; scale:2.8; border:1px solid white"
                cerchioBottom.style="bottom:-40%; right:20%; scale:2.4;border:1px solid white"
                cerchioTop.classList.add('cerchio-top-animazione')
                cerchioTop.style="background-color:rgba(255, 255, 255, 0.1); border:none;"
                cerchioBottom.style="background-color:rgba(255, 255, 255, 0.1);border:none;"
                cerchioBottom.classList.add('cerchio-bottom-animazione')
                bg.style="background-color:"+confArray[contatore][4];

            }else if(cerchioTop.classList.contains('cerchio-top-animazione')){
                navbar.classList.remove('navbar-dark')
                cerchioTop.classList.remove('cerchio-top-animazione')
                cerchioBottom.classList.remove('cerchio-bottom-animazione')
                //Cerchi nascossti
                cerchioHiddenBottom.style="display:block; background-color:rgba(0, 0, 0, 0.1) ;bottom:-40%; right:20%; scale:2.4;border:1px solid white; border:none"
                cerchioHiddenTop.style="display:block; background-color:rgba(0, 0, 0, 0.1) ;top:-10%; left:10%; scale:2.8; border:1px solid white; border:none"
                cerchioHiddenTop.classList.add('cerchio-top-animazione-hidden')
                cerchioHiddenBottom.classList.add('cerchio-bottom-animazione-hidden')
                //---------------
                bg.style="background-color:white";
            }else{
                navbar.classList.remove('navbar-dark')
                //Cerchi nascossti
               cerchioHiddenBottom.style="display:block; background-color:rgba(0, 0, 0, 0.1) ;bottom:-40%; right:20%; scale:2.4;border:1px solid white; border:none"
               cerchioHiddenTop.style="display:block; background-color:rgba(0, 0, 0, 0.1) ;top:-10%; left:10%; scale:2.8; border:1px solid white; border:none"
               cerchioHiddenTop.classList.add('cerchio-top-animazione-hidden')
               cerchioHiddenBottom.classList.add('cerchio-bottom-animazione-hidden')
               //---------------
                bg.style="background-color:white";
            }

            if(confArray[contatore][0]=='extra'){
                cerchioHiddenBottom.style="display:block; background-color:rgba(0, 0, 255, 0.3);bottom:-40%; right:20%; scale:2.4;border:1px solid white; border:none"
               cerchioHiddenTop.style="display:block; background-color:rgba(255, 0, 0, 0.3) ;top:-10%; left:10%; scale:2.8; border:1px solid white; border:none"
            }
        }

        //comportamento indexbox
        function indexBoxCreation(){
            
            for(let i = 0; i<=confArray.length-1; i++){
                createElementAppend('div', 'border-circle','', indexBox, 1);
            } 

            let indici = document.querySelectorAll('.border-circle');
            indici[contatore].classList.add('active');

        }

        function miniIndexBoxCreation(){
            
            miniIndexBox.innerHTML="";
            for(let i = 0; i<=confArray[contatore][3].length-1; i++){
                createElementAppend('div', 'border-circle-mini','', miniIndexBox, 1);
            } 

            let indici = document.querySelectorAll('.border-circle-mini');
            indici[0].classList.add('active');

        }

        function miniIndexBoxBehavior(){
            
            let indici = document.querySelectorAll('.border-circle-mini')
          
            for(let i = 0; i<=confArray[contatore][3].length-1; i++){
                indici[i].classList.remove('active')
            } 
            indici[contatoreOrizzontale].classList.add('active')
        }

        function indexBoxBehavior(){
            
            let indici = document.querySelectorAll('.border-circle')
           
            for(let i = 0; i<=confArray.length-1; i++){
                indici[i].classList.remove('active')
                if(confArray[contatore][2]==true){
                  indici[i].style="background:white"  
                }else{
                    indici[i].style="background:black"  
                }
            } 
            indici[contatore].classList.add('active')
        }

        //rende cliccabili le index in basso
        function indexBehavior(){
            let links=document.querySelectorAll('.border-circle');
                for(let i = 0; i<=links.length-1; i++){
                    if(contatore>=i){
                        links[i].addEventListener('click', ()=>{
                            contatore=i;
                            scrollDown()  
                        })
                    }else if(contatore<i){
                        links[i].addEventListener('click', ()=>{
                            contatore=i;
                            scrollUp()
                        })
                    }
                }
        }

        function miniIndexBehavior(){
            let links=document.querySelectorAll('.border-circle-mini');
            for(let i = 0; i<=links.length-1; i++){
                links[i].addEventListener('click', ()=>{
                     
                    //console.log(contatoreOrizzontale)
                        //console.log(i)
                    if(contatoreOrizzontale>=i){
                        if (isAnimated == false && i>=0 && i<confArray[contatore][3].length-1) {         
                            isAnimated = true;
                            contatoreOrizzontale=i;

                            LeftScrollableEl.innerHTML = '';
                            creaContenutoLeftSlide(contatore, contatoreOrizzontale)
                            scrollElCenterRight(MainScrollableEl);
                            scrollElRightCenter(LeftScrollableEl);

                            let timer = setTimeout(() => {
                                    isAnimated = false
                            }, 2200)

                            // if(contatoreOrizzontale=!0 && contatoreOrizzontal)
                            
                            
                            // Creazione pagina principale
                            let creazioneContenutoMain = setTimeout(() => {
                                if(contatoreOrizzontale==0){
                                    MainScrollableEl.innerHTML = '';
                                    creaContenutoMain(contatore)
                                }else{
                                    MainScrollableEl.innerHTML = '';
                                    creaContenutoMainSlide(contatore, contatoreOrizzontale)
                                }
                                }, 980);

                            miniIndexBoxBehavior();
                            // Layout Delle foto
                            if(confArray[contatore][2]){
                                let layout = document.getElementById('layout');
                                if(contatoreOrizzontale==0){
                                    layout.style="opacity:0"
                                }else if(contatoreOrizzontale>0){
                                    layout.style="opacity:1";
                                }else{
                                    layout.style="opacity:0"
                                }
                            }
                            
                        }
                    }else if(contatoreOrizzontale<i){
                
                        if (isAnimated == false && i>0 && i<=confArray[contatore][3].length-1) {
                            isAnimated = true;
                            
                            contatoreOrizzontale=i;
                        
                            RightScrollableEl.innerHTML = '';
                            creaContenutoRightSlide(contatore, contatoreOrizzontale)
                    
                            scrollElCenterLeft(MainScrollableEl);
                            scrollElLeftCenter(RightScrollableEl);
                            // contatoreOrizzontale--;
                            
                            // Creazione pagina principale
                            let creazioneContenutoMain = setTimeout(() => {
                                    MainScrollableEl.innerHTML = '';
                                        creaContenutoMainSlide(contatore, contatoreOrizzontale)
                                }, 980);
                                
                                let timer = setTimeout(() => {
                                    isAnimated = false
                                }, 2200)
                                
                                miniIndexBoxBehavior();
                                if(confArray[contatore][2]){
                                    let layout = document.getElementById('layout');
                                    if(contatoreOrizzontale==0){
                                        layout.style="opacity:0"
                                    }else if(contatoreOrizzontale>0){
                                        layout.style="opacity:1";
                                    }else{
                                        layout.style="opacity:0"
                                    }
                                }
                            }
                        }
                    }
                )}
        }
         
            //Funzione di scroll
        function scrollDown(){
                contatoreOrizzontale=0;
            
                if (contatore == confArray.length) {
                    contatore = 0
                }
                if (contatore == 0) {
                    precontatore = confArray.length - 1
                } else {
                    precontatore = contatore - 1;
                }
                if (contatore == confArray.length - 1) {
                    postcontatore = 0
                } else {
                    postcontatore = contatore + 1;
                }
                
                //Solo il main ha le animazioni del background
                backgroundAnimation();
                //Comportamento indice
                indexBoxBehavior()
                

                // Creazione pagina principale
                let creazioneContenutoMain = setTimeout(() => {
                    MainScrollableEl.innerHTML = '';
                    creaContenutoMain(contatore);

                }, 750)

                let creazioneContenutoSecond = setTimeout(() => {

                    TopScrollableEl.innerHTML = '';
                    creaContenutoTop(precontatore);

                    BottomScrollableEl.innerHTML = '';
                    creaContenutoBottom(postcontatore);
                }, 1200)
               
                if(confArray[contatore][2]==true){
                    miniIndexBoxCreation();
                    miniIndexBehavior();
                }else{
                    miniIndexBox.innerHTML=""
                }

                // Layout Delle foto
                let layout = document.getElementById('layout');
                layout.style="opacity:0";    
        }

        function scrollUp(){
            contatoreOrizzontale=0;

            if (contatore == -1) {
                contatore = confArray.length - 1
            }
            if (contatore == 0) {
                precontatore = confArray.length - 1
            } else {
                precontatore = contatore - 1;
            }
            if (contatore == confArray.length - 1) {
                postcontatore = 0
            } else {
                postcontatore = contatore + 1;
            }

            //Solo il main ha le animazioni del background
            backgroundAnimation();  
            //Comportamento indice
            indexBoxBehavior();

            

            // Creazione pagina principale
            let creazioneContenutoMain = setTimeout(() => {
                MainScrollableEl.innerHTML = '';
                creaContenutoMain(contatore);
            }, 980);

            let creazioneContenutoSecond = setTimeout(() => {

                TopScrollableEl.innerHTML = '';
                creaContenutoTop(precontatore);

                BottomScrollableEl.innerHTML = '';
                creaContenutoBottom(postcontatore);
            }, 1200)

            if(confArray[contatore][2]==true){
                    miniIndexBoxCreation()
                    miniIndexBehavior();
                }else{
                    miniIndexBox.innerHTML=""
                }

                // Layout Delle foto
                let layout = document.getElementById('layout');
                layout.style="opacity:0";  
        }

        function scrollLeft(){
            if (isAnimated == false && contatoreOrizzontale>0 && contatoreOrizzontale<=confArray[contatore][3].length-1) {
                isAnimated = true;
                LeftScrollableEl.innerHTML = '';
                    creaContenutoLeftSlide(contatore, contatoreOrizzontale - 1)
                    RightScrollableEl.innerHTML = '';
                    creaContenutoRightSlide(contatore, contatoreOrizzontale + 1)  
                    scrollElCenterRight(MainScrollableEl);
                    scrollElRightCenter(LeftScrollableEl);
                let timer = setTimeout(() => {
                    isAnimated = false
                }, 2200)
                contatoreOrizzontale--;
            
                // Creazione pagina principale
                let creazioneContenutoMain = setTimeout(() => {
                    MainScrollableEl.innerHTML = '';
                    if(contatoreOrizzontale==0){
                        creaContenutoMain(contatore);
                    }else{
                        creaContenutoMainSlide(contatore, contatoreOrizzontale)
                    }
                }, 980);
        
                let creazioneContenutoSecond = setTimeout(() => {
                    LeftScrollableEl.innerHTML = '';
                    creaContenutoLeftSlide(contatore, contatoreOrizzontale - 1)
                    RightScrollableEl.innerHTML = '';
                    creaContenutoRightSlide(contatore, contatoreOrizzontale + 1)            
                }, 1200)

                miniIndexBoxBehavior();
                if(confArray[contatore][2]){
                    let layout = document.getElementById('layout');
                    if(contatoreOrizzontale==0){
                        layout.style="opacity:0"
                    }else if(contatoreOrizzontale>0){
                        layout.style="opacity:1";
                    }else{
                        layout.style="opacity:0"
                    }
                }
            }
        }

        function scrollRight(){
            if (isAnimated == false && contatoreOrizzontale>=0 && contatoreOrizzontale<confArray[contatore][3].length-1) {         
                    isAnimated = true;
                    LeftScrollableEl.innerHTML = '';
                    creaContenutoLeftSlide(contatore, contatoreOrizzontale - 1)
                    RightScrollableEl.innerHTML = '';
                    creaContenutoRightSlide(contatore, contatoreOrizzontale + 1)

                    scrollElCenterLeft(MainScrollableEl);
                    scrollElLeftCenter(RightScrollableEl);
                    let timer = setTimeout(() => {
                        isAnimated = false
                    }, 2200)
                    contatoreOrizzontale++;
                
                    // Creazione pagina principale
                let creazioneContenutoMain = setTimeout(() => {
                    MainScrollableEl.innerHTML = '';
                    creaContenutoMainSlide(contatore, contatoreOrizzontale)
                    }, 980);

                let creazioneContenutoSecond = setTimeout(() => {
                    LeftScrollableEl.innerHTML = '';
                    creaContenutoLeftSlide(contatore, contatoreOrizzontale - 1)
                    RightScrollableEl.innerHTML = '';
                    creaContenutoRightSlide(contatore, contatoreOrizzontale + 1)
                    }, 1200)

                miniIndexBoxBehavior();
                // Layout Delle foto
                if(confArray[contatore][2]){
                    let layout = document.getElementById('layout');
                    if(contatoreOrizzontale==0){
                        layout.style="opacity:0"
                    }else if(contatoreOrizzontale>0){
                        layout.style="opacity:1";
                    }else{
                        layout.style="opacity:0"
                    }
                }
            }
        }
        //Fine Funzioni
        //------------------------------------------------------
        
   
        //scaffholding
        indexBoxCreation();
        indexBehavior()
        backgroundAnimation()
        creaContenutoMain(contatore);
        creaContenutoTop(precontatore);
        creaContenutoBottom(postcontatore);
        //------------------------------------------------------

    

        //Scroll Event Listener
        window.onwheel = event => {
            if (event.deltaY >= 0) {
                // Scrolling Down with mouse
                // console.log('Scroll Down', isAnimated);
                if (isAnimated == false) {
                
                    isAnimated = true;
                    scrollElCenterDown(MainScrollableEl);
                    scrollElBottomCenter(BottomScrollableEl);
                    let timer = setTimeout(() => {
                        isAnimated = false
                    }, 2200)

                contatore++;
                scrollDown();

                contatoreOrizzontale=0
                if(confArray[contatore][2]==true){
                    RightScrollableEl.innerHTML="";
                    creaContenutoRightSlide(contatore, contatoreOrizzontale+1)
                }
                }
    
            } else {
                // Scrolling Up with mouse
                //console.log('Scroll Up');
                if (isAnimated == false) {
                    isAnimated = true;
                    scrollElCenterUp(MainScrollableEl)
                    scrollElTopCenter(TopScrollableEl);
                    let timer = setTimeout(() => {
                        isAnimated = false
                    }, 2200)

                    contatore--;

                    scrollUp();
                    contatoreOrizzontale=0
                    if(confArray[contatore][2]==true){
                    RightScrollableEl.innerHTML="";
                    creaContenutoRightSlide(contatore, contatoreOrizzontale+1)
                }
            }

            if (event.deltaX >= 0) {
                // Scrolling Down with mouse
                //console.log('Scroll Left');
            } else {
                // Scrolling Up with mouse
                //console.log('Scroll Right');
            }
        }
        }
    </script>
</body>

</html>