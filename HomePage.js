
function stop()
{
  var list = document.getElementById("list")
  if(list.childNodes.length>0)
  {
  var first = list.childNodes[0]
  list.removeChild(first)
}
}
