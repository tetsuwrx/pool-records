function Base(){
    document.write("AAA");
}
function x1_Change(){
    var a = parseInt(document.f0.elements['a1'].value);
    var b = parseInt(document.f0.elements['b1'].value);
    if(a > 10 || b > 10 || a + b > 10){ alert("入力値が誤っています"); }
}
function x2_Change(){
    var a = parseInt(document.f0.elements['a2'].value);
    var b = parseInt(document.f0.elements['b2'].value);

    if(a+b==10){}

}


//*a1*/
function a1scorechangeA(){
        var scre = document.f1.elements['a1scoreA'].value;
            if(scre=="score"){document.f1.elements['a1scoreA'].value=""}
}
function a1scorechangeB(){
    var scre = document.f1.elements['a1scoreB'].value;
    if(scre=="score"){document.f1.elements['a1scoreB'].value=""}
}
function a1InputChange(){
    var form = document.createElement('form');
    form.action = 'index.php';
    form.method = 'POST';
    form.name = 'a1SSSSSS';
    var a = document.createElement('input'); a.value = "a1"; a.type = "hidden"; a.name = 'JSPOST'; form.appendChild(a);
    var b = document.createElement('input'); b.value = document.f1.elements['a1Date'].value; b.type = "hidden"; b.name = 'a1Date'; form.appendChild(b);
    var c = document.createElement('input'); c.value = document.f1.elements['a1memberA'].value; c.type = "hidden"; c.name = 'a1memberA'; form.appendChild(c);
    var d = document.createElement('input'); d.value = document.f1.elements['a1memberB'].value; d.type = "hidden"; d.name = 'a1memberB'; form.appendChild(d);
    var e = document.createElement('input'); e.value = document.f1.elements['a1RankA'].value; e.type = "hidden"; e.name = 'a1RankA'; form.appendChild(e);
    var f = document.createElement('input'); f.value = document.f1.elements['a1RankB'].value; f.type = "hidden"; f.name = 'a1RankB'; form.appendChild(f);
    var g = document.createElement('input'); g.value = document.f1.elements['a1scoreA'].value; g.type = "hidden"; g.name = 'a1scoreA'; form.appendChild(g);
    var h = document.createElement('input'); h.value = document.f1.elements['a1scoreB'].value; h.type = "hidden"; h.name = 'a1scoreB'; form.appendChild(h);
    var i = document.createElement('input'); i.value = document.f1.elements['a1winner'].value; i.type = "hidden"; i.name = 'a1winner'; form.appendChild(i);
    var j = document.createElement('input'); j.value = document.f1.elements['a1masuA'].value; j.type = "hidden"; j.name = 'a1masuA'; form.appendChild(j);
    var k = document.createElement('input'); k.value = document.f1.elements['a1masuB'].value; k.type = "hidden"; k.name = 'a1masuB'; form.appendChild(k);
    var l = document.createElement('input'); l.value = document.f1.elements['ax1'].value; l.type = "hidden"; l.name = 'ax1'; form.appendChild(l);
    document.body.appendChild(form);
    form.submit();

    //var fp = new FormData();
    //fp.append("JSPOST", "a1");
    //fp.append("a1Date", document.f1.elements['a1Date'].value);
    //fp.append("a1memberA", document.f1.elements['a1memberA'].value);
    //fp.append("a1memberB", document.f1.elements['a1memberB'].value);
    //fp.append("a1RankA", document.f1.elements['a1RankA'].value);
    //fp.append("a1RankB", document.f1.elements['a1RankB'].value);
    //fp.append("a1scoreA", document.f1.elements['a1scoreA'].value); 
    //fp.append("a1scoreB", document.f1.elements['a1scoreB'].value);   
    //$.ajax({
    //    url: 'index.php',
    //    type: 'POST',
    //    data: fp,
    //    processData: false,
    //    contentType: false,
    //});
}



//*a4*/
function a4nameckick(){
    var v = document.f4.elements['a4name'].value;
    if(v=="ニックネーム"){document.f4.elements['a4name'].value = "";}
}

