


function logar(){
    let Relatorio = document.getElementById('PgRel');
    let qlogin = document.getElementById('PagLog');
    // let buttom = document.getElementById('btn-login')
    let nomes = document.getElementById('usuario').value;
    let senha = document.getElementById('senha').value;
    
    if (nomes=="admin" && senha=="admin"){
        hidden(qlogin);
       
    }else{
        alert("login ou senha incorretos")
    };

    mostrar(Relatorio);

}


function hidden(ocutar){
   
    ocutar.classList.add('hidden');
    
}


function mostrar(show){
    show.classList.remove('hidden');
    show.classList.add('show');
}


function next(id){
    id.classList.remove('show');
    let Relatorio2 = document.getElementById('PgRel2');
    hidden(id);  
    mostrar(Relatorio2);

}
