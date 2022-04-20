





function valideKey(evt){
    
  // code is the decimal ASCII representation of the pressed key.
  var code = (evt.which) ? evt.which : evt.keyCode;
  
  if(code==8) { // backspace.
    return true;
  } else if(code>=48 && code<=57) { // is a number.
    return true;
  } else{ // other keys.
    return false;
  }
}




function filterFloat(evt,input){
  // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
  var key = window.Event ? evt.which : evt.keyCode;    
  var chark = String.fromCharCode(key);
  var tempValue = input.value+chark;
  if(key >= 48 && key <= 57){
      if(filter(tempValue)=== false){
          return false;
      }else{       
          return true;
      }
  }else{
        if(key == 8 || key == 13 || key == 46 || key == 0) {            
            return true;              
        }else{
            return false;
        }
  }
}




function filterFloat1(evt,input){
  // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
  var key = window.Event ? evt.which : evt.keyCode;    
  var chark = String.fromCharCode(key);
  var tempValue = input.value+chark;
  if(key >= 48 && key <= 57){
      if(filter1(tempValue)=== false){
          return false;
      }else{       
          return true;
      }
  }else{
        if(key == 8 || key == 13 || key == 46 || key == 0) {            
            return true;              
        }else{
            return false;
        }
  }
}


function filter(__val__){
  var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
  if(preg.test(__val__) === true){
      return true;
  }else{
     return false;
  }
  
}

function filter1(__val__){
  var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
  if(preg.test(__val__) === true){
      return true;
  }else{
     return false;
  }
  
}