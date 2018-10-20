var content = document.querySelector("small");//写入duedate的地方
var buttonsMovieBox = document.getElementsByClassName("btnreserve");//movie_box页面，所有带btnreserve这个class的按钮，这是个array
var buttonsMyMovie = document.getElementsByClassName("btnremove");//my_movie页面，所有带btnreserve这个class的按钮，这是个array
var buttons_list1 = buttonsMovieBox.length;//movie_box页面,按钮array的数量
var buttons_list2 = buttonsMyMovie.length;//my_movie页面,按钮array的数量

for(var i=0; i<buttons_list1; i++) {//遍历每一个按钮
  buttonsMovieBox[i].addEventListener("click", showTips);//从array的第1个按钮开始，每个按钮都绑定监听事件

  function showTips(event) {
    content.innerHTML = "Reserved successfully! " + "<b>" + "Duedate: November 20th, 2018." + "</b>";
    content.setAttribute("class", "notice");
  }
}

for(var i=0; i<buttons_list2; i++) {//遍历每一个按钮
  buttonsMyMovie[i].addEventListener("click", showInfo);//从array的第1个按钮开始，每个按钮都绑定监听事件

  function showInfo(event) {
    content.innerHTML = "<b>" + "Remove successfully!" + "</b>";
    content.setAttribute("class", "notice");
  }
}
