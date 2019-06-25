<!DOCTYPE HTML>
<html>
  <head>
    <title>Guess numbers</title>
    <script src="https://kit.fontawesome.com/7df1d0e2a0.js"></script>
    <script src = "scripts/js/vue.js"></script>
    <script src = "scripts/js/jshelper/jshelper.js"></script>
    <script src = "scripts/js/func.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href = "css/main.css" rel = "stylesheet">
  </head>
  <body>
    <div id = "app">
      <div id = "user-container" class = "text-container">
        <?php
          $username = $_COOKIE['username']; # getting data from cookies
            
          if (isset($username) and $username != ''){ ?> <p class = "title" id = "title-user">Профиль<i class="fas fa-user-alt"></i></p><span id = "profile-text-container"><i class="fas fa-user-circle"></i><?php echo "Имя: $username;"; ?><br /><i class="fas fa-sign-out-alt"></i><a href = "logout.php" class = "link">Выйти</a></span><?php } else { ?>
          <span id = "not-in-user-text">
            <p class = "title" id = "title-user">Вы не вошли в систему!</p>
            <a href = "login.php" class = "link">Войдите</a> или <a href = "signup.php" class = "link">зарегистрируйтесь</a>. <?php }?>
          </span>
      </div>
      <div id = "main-num-container">
        <div v-for = "num in numbers" class = "tr-container">
          <transition name = "trNum">
            <div v-bind:id = "num.index" class = "number" v-show = "num.isShow == true" @click = "init(num.value,num.index)">
                <div>{{ num.toShow }}</div>
            </div>
          </transition>
        </div>
      </div>
      <div id = "after-container">
        <transition name = "trText">
          <div id = "main-text-container" class = "text-container" v-show = "isFinal">
            <p class = "title">Вы победили!<br /> Время прохождения: {{ numSeconds }} секунд(ы)</p>
          </div>
        </transition>
        <transition name = "trButton">
          <div v-show = "isFinal">
            <a v-bind:href = "url" class = "text-button" v-show = "isShowButt"><div class = "button-container">сохранить</div></a>
            <a href = "#" @click = "reload(700)" class = "text-button"><div class = "button-container">Начать с начала</div></a>
          </div>
        </transition>
      </div>
      <div id = "options-container" class = "text-container">
        <p id = "title-options" class = "title">настройки<i class="fas fa-cogs"></i></p>    
            <form id = "options-form">
              <i class="fas fa-square-full"></i><label for = "form-number-input">Число ячеек:</label><input v-model.number = "len" step = 2 type = "number" id = "form-number-input">
            </form>
            <div id = "form-time"><i class="fas fa-clock"></i>Секунд прошло: {{ numSeconds }}</div>
            <div id = "error-text" v-show = "isErrorLen">
              {{ errorLenText }}
            </div>
      </div>
      <div id = "records-container" class = "text-container">
        <p id = "title-records" class = "title">таблица рекордов<i class="fas fa-running"></i></p>
        <?php
          # TABLE OF RECORDS
          require('scripts/php/config.php');
          
          # sql injection from 'saves' database
          # setting order by speed
          $query = "SELECT * FROM saves ORDER BY speed DESC";
          $result = mysqli_query($mysqli, $query);
          mysqli_close($mysqli);

          # writing data to the main page with <ol><li></li></ol> construction
          echo "<ol>";

          while ($row = mysqli_fetch_assoc($result)){
            echo "<li><b>Коэффициент скорости: ".$row['speed']."; Имя игрока: ".$row['username']."; Время прохождения: ".$row['value']." секунд(ы); Количество ячеек: ".$row['countCells'].".</b></li>";
          }

          echo "</ol>";
        ?>
      </div>
    </div>
    <script>
      const jsH = new JsHelper;
      
      // VUE code
      const app = new Vue({
        el: "#app",
        data: {
          numbers: [],
          len: 16,
          nowNum: -1,
          score: 0,
          showedIndex: -1,
          isFinal: false,
          url: "",
          numSec: 0,
          isShowButt: true,
          isErrorLen: false,
          errorLenText: "Только чётные числа!",
          numSeconds: 0,
          mainInterval: ""
        },
        watch: {
          score: function(){
            if (this.score == Math.round(this.len / 2)){ // if user has won
              clearInterval(this.mainInterval); // clearing interval
              // creating 'url' variable for redirection
              <?php if (isset($username) and $username != ''){?> 
                this.url = "scripts/php/add.php?value=" + this.numSeconds + "&username=<?php echo "$username"; ?>" + "&countCells=" + this.len;
              <?php } else{?>
                this.url = "#";
                this.isShowButt = false;
              <?php }?>
              this.isFinal = true;
            }
          },
          len: function(){
            if ((this.len % 2) == 0){
                this.reload(100); 
                this.isErrorLen = false;
            }
            else
                this.isErrorLen = true;
          }
        },
        created: function(){
          this.create();
        },
        methods: {
          create: function(){
            // GAME ALGORITM
            var preform = [],
                arr1 = [],
                arr2 = [];

            
            // filling the array with data
            for (let i = 0; i < this.len / 2; i ++) preform.push(i)

            // shuffling array, and concatenation
            arr1 = shuffle(preform);
            arr2 = shuffle(preform);
            arrRes = arr1.concat(arr2);

            
            // filling main array with correct data
            for (let i = 0; i < arrRes.length; i ++){
              this.numbers.push({
                "value": arrRes[i],
                "index": i,
                "toShow": arrRes[i],
                "isShow": true
              });
            }

            setTimeout( () => {
              for (let numIndex = 0; numIndex < this.numbers.length; numIndex ++) this.numbers[numIndex].toShow = "*";
            }, 2000);

            this.mainInterval = setInterval(() => {
              this.numSeconds++;
            },1000);
          },
          init: function(num,index){
            // THE MAIN PROCESS
            if (this.nowNum != -1){
              if (num == this.nowNum){
                if (this.showedIndex != index){
                  for (let g = 0; g < this.numbers.length; g ++){
                    if (this.numbers[g].value == num){
                      this.numbers[g].toShow = num;
                      this.numbers[g].isShow = "false";
                    }
                  }
                  this.score ++;
                } else this.numbers[this.showedIndex].toShow = "*";

              } else this.numbers[this.showedIndex].toShow = "*";
              this.nowNum = -1;
            } else{
              this.nowNum = num;
              this.numbers[index].toShow = num;
              this.showedIndex = index;
            }
          },
          reload: function(timeoutTime){
            // reloading data
            // timeoutTime: 
            //              700 for animation
            //              100 for reloading by changing length

            this.numbers = [];
            this.nowNum = -1;
            this.score = 0;
            this.showedIndex = -1;
            this.isFinal = false;
            this.numSeconds = 0;
            clearInterval(this.mainInterval);
            setTimeout( () => {
              this.create();
            }, timeoutTime);
          }
        }
      });
    </script>
  </body>
</html>