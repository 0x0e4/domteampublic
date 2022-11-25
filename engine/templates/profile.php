<html><head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./engine/js/main.js"></script>
    <link rel="stylesheet" href="./main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./engine/js/main.js"></script>
        <link rel="stylesheet" href="./main.css">
        
        
            <title>Test1 Test2    </title>
            <link rel="stylesheet" href="./main.css">
            <link rel="stylesheet" href="./engine/styles/header_main_page.css">
            <link rel="stylesheet" href="./engine/styles/profile.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript" src="./engine/js/Sliding_Panel.js"></script>
            <script type="text/javascript" src="./engine/js/advers.js"></script>
            <script type="text/javascript" src="./engine/js/main.js"></script>
            <meta charset="utf-8">
        <style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style><style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style>
    <style>
    /* width */
    ::-webkit-scrollbar {
        width: 11px;
        background-color: #828282;
    }
    
    /* Track */
    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
      border-radius: 10px;
      background-color: #828282;
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #D9D9D9;
    }
    
    
    </style>
    </head>
        <body>
            <header> <div class="header-panel">
  	<div class="container" onclick="Sliding_Panel()">
  		<img src="../../engine/images/munu_bar.svg" id="menu_bar_image">
  		<div id="Sliding_Panel" class="Sliding_Panel">
  			<button class="To_Add_Adver_Button" onclick="navigateTo('./addadver')">Создать объявление</button>
  			<button class="To_Add_Adver_Button" onclick="navigateTo('./tags')">Тэги</button>
  		</div>
  	</div>
  	<img src="../../engine/images/domteam_logo.svg" id="main_page_logo">
    
  	  	</div>
                    
        
                
      </header>
      
      <div class="background_site">
              <div id="block_user_info" class="block_user_info"></div>
    <img id="user_photo" class="user_photo" src="./engine/storage/default.jpg">
      
      <div id="user_name" class="user_name">Test1 Test2</div>
      <div id="person_info" class="person_info">Информация о человеке:</div>
      <div id="user_age" class="user_age">Возраст: 2022</div>
      <div id="user_address" class="user_address">Адрес: </div>
      <div id="phone_number" class="phone_number">Номер телефона: </div><div id="about_me" class="about_me">Обо мне:
      
      </div><div id="block_advers" class="block_advers">
        <div id="scroll">
          <div class="overflow"></div>
    </div></div>
    
                        </div>
      
      <footer>
        
      </footer>
      
      
      <script>
            var returnedSuggestion = ''
            let editor, doc, cursor, line, pos
            document.addEventListener("keydown", (event) => {
            setTimeout(()=>{
                editor = event.target.closest('.CodeMirror');
                if (editor){
                    doc = editor.CodeMirror.getDoc()
                    cursor = doc.getCursor()
                    line = doc.getLine(cursor.line)
                    pos = {line: cursor.line, ch: line.length}
                    if (event.key == "Enter"){
                        var query = doc.getRange({ line: Math.max(0,cursor.line-10), ch: 0 }, { line: cursor.line, ch: 0 })
                        window.postMessage({source: 'getSuggestion', payload: { data: query } } )
                        //displayGrey(query)
                    }
                    else if (event.key == "ArrowRight"){
                        acceptTab(returnedSuggestion)
                    }
                }
            }, 0)
            })
    
            function acceptTab(text){
            if (suggestionDisplayed){
                doc.replaceRange(text, pos)
                suggestionDisplayed = false
            }
            }
            function displayGrey(text){
            var element = document.createElement('span')
            element.innerText = text
            element.style = 'color:grey'
            var lineIndex = pos.line;
            editor.getElementsByClassName('CodeMirror-line')[lineIndex].appendChild(element)
            suggestionDisplayed = true
            }
            window.addEventListener('message', (event)=>{
            if (event.source !== window ) return
            if (event.data.source == 'return'){
                returnedSuggestion = event.data.payload.data
                displayGrey(event.data.payload.data)
            }
            })
        </script></body></html>