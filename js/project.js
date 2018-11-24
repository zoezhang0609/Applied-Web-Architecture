var drop= document.getElementsByClassName("jsdom");

for(var count=0; count<drop.length; count++) {
  drop[count].addEventListener("change", check_id);
}
//check_id();

function check_id(event) {

  var array=[];

  for(var count=0; count<drop.length; count++) {
    
    var mydb=drop[count];
    array[count] = mydb.options[mydb.selectedIndex].value;

    console.log(array[count]);
  }

  array = array.sort();
  
  var isduplicate = false;
  for(var count=0; count<array.length-1; count++) {
    if(array[count]==array[count+1]) {
      isduplicate = true;
    }
  }
  if(isduplicate) {
    document.getElementsByClassName("jssave")[0].style.display="none";
  } else {
    document.getElementsByClassName("jssave")[0].style.display="inline-block";
  }
  
}