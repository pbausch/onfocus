function highlightLastLI() {
    var liList, ulTag, liTag;
    var ulList = document.getElementsByTagName("ul");
    for (var i = 0; i < ulList.length; i++) {
        ulTag = ulList[i];
        liList = ulTag.getElementsByTagName("li");
        liTag = liList[liList.length - 1];
        liTag.style.marginBottom = '0px';
    }
}