<?php
require_once "./engine/models/adver.php";

$db = open_database_connection();
$data = getUserData($uid);
$format = "";
$age = 0;
$myaddr = "";
$advers = array();
if($data != null)
{
    $format = getPhotoFormat($data['avatar'], false);
    if($format == "")
        $data['avatar'] = 'default.jpg';
    $age = getAge($data['birthday']);
    $myaddr = getAddr($uid);
    $advers = getAdversOfUser($uid);
    $houses = getHousesOfUser($uid);
    $addr = getHousesAddress($houses);
}
?>
<html><head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./engine/js/main.js"></script>
    <link rel="stylesheet" href="./main.css">
    
    
        <title><?php echo $data != null ? $data['name']." ".$data['surname'] : "Профиль не найден"; ?>
    </title>
        <link rel="stylesheet" href="./main.css">
        <link rel="stylesheet" href="./engine/styles/header_main_page.css">
        <link rel="stylesheet" href="./engine/styles/profile.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="./engine/js/Sliding_Panel.js"></script>
        <script type="text/javascript" src="./engine/js/advers.js"></script>
        <script type="text/javascript" src="./engine/js/main.js"></script>
        <meta charset="utf-8">
    <style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></head>
    <body> <header> <div class="header-panel">
        <div class="container" onclick="Sliding_Panel()">
            <div class="bar_icon"></div>
            <div class="bar_icon"></div>
            <div class="bar_icon"></div>
            <div id="Sliding_Panel" class="Sliding_Panel">
                <button class="To_Add_Adver_Button" onclick="navigateTo('./addadver')">Создать объявление</button>
                <button class="To_Add_Adver_Button" onclick="navigateTo('./tags')">Тэги</button>
            </div>
        </div>
        <?php if(!$GLOBALS['logged']) { ?>
    <button id="Enter_Button" class="Enter_Button" onclick="navigateTo('./login')">Войти</button>
    <button id="Register_Button" class="Enter_Button" onclick="navigateTo('./register')">Зарегистрироваться</button>
  <?php } else { ?>
    <button id="Enter_Button" class="Enter_Button" onclick="navigateTo('./profile')">Мой профиль</button>
  <?php } ?>
      </div>
  
  </header>
  
  <div class="background_site">
    <?php if($data != null) { ?>
      <img id="user_photo" class="user_photo" src="./engine/storage/<?php echo $data['avatar'].$format; ?>">
  
  <div id="user_name" class="user_name"><?php echo $data['name']." ".$data['surname']; ?></div>
  <div id="person_info" class="person_info">Информация о человеке:</div>
  <div id="user_age" class="user_age">Возраст: <?php echo $age; ?></div>
  <div id="user_address" class="user_address">Адрес: <?php echo $myaddr; ?></div>
  <div id="phone_number" class="phone_number">Номер телефона: <?php echo $data['phone']; ?></div><div id="about_me" class="about_me">Обо мне:
  
  <?php echo $data['about_me']; ?></div><div id="block_advers" class="block_advers">
                    <?php for($i = 0; $i < count($advers); $i++) {
            $tagsid = json_decode($advers[$i]['tags']);
            $tags = getAdverTags($tagsid);
        ?>
        <div class="topic"><?php echo $advers[$i]['topic']; ?></div><br><br>
        <?php if($advers[$i]['photo_id'] != "") { ?>
        <div><img class="picture" src="./engine/storage/<?php echo $advers[$i]['photo_id'].getPhotoFormat($advers[$i]['photo_id']); ?>"></div>
    <?php } ?>
        <div class="time"><?php echo date('Y-m-d H:i', $advers[$i]['time']); ?></div><br>
        <?php if(count($tagsid) > 0) { ?>
        <div class="tags">Теги: <?php echo implode(',', $tags); ?></div><br>
    <?php } ?>
        <div class="hid">Адрес дома: <?php echo $addr[array_search($advers[$i]['hid'], $houses)]; ?></div><br>
        <div class="text"><?php echo $advers[$i]['text']; ?></div><hr>
    <?php }
    close_database_connection($db);
     ?>
                  </div>
                  <?php } else { ?>
                    <div class="person_info">Профиль не существует!</div>
                  <?php } ?>
  </div>
  
  <footer>
    
  </footer>
  
  
  </body></html>