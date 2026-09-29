document.addEventListener("DOMContentLoaded",()=>{

const quiz=[

{
question:"¿Quién es conocida como la Reina del Upper East Side?",
answers:["Serena","Blair","Jenny","Georgina"],
correct:1
},

{
question:"¿Quién es el mejor amigo de Chuck Bass?",
answers:["Dan","Nate","Eric","Louis"],
correct:1
},

{
question:"¿En qué barrio vive Dan Humphrey?",
answers:["Brooklyn","Queens","Manhattan","SoHo"],
correct:0
},

{
question:"¿Cómo se llama la fiel ama de llaves de Blair?",
answers:["Ivy","Dorota","Juliet","Lily"],
correct:1
},

{
question:"¿Qué hotel pertenece a Chuck Bass?",
answers:["Empire Hotel","Plaza","The Pierre","The Mark"],
correct:0
},

{
question:"¿En qué estación vuelve Serena en el primer episodio?",
answers:["Penn Station","Grand Central","Times Square","Union Square"],
correct:1
},

{
question:"¿Cómo se llama el colegio de Blair y Serena?",
answers:["St. Jude's","Constance Billard","Columbia Prep","Hamilton Academy"],
correct:1
},

{
question:"¿Quién es el hermano menor de Serena?",
answers:["Dan","Nate","Eric","Scott"],
correct:2
},

{
question:"¿Cuál es la frase más famosa de Gossip Girl?",
answers:[
'You know you love me. XOXO, Gossip Girl',
"Spotted on the Upper East Side",
"Hello Manhattan",
"Secrets never sleep"
],
correct:0
},

{
question:"¿En qué ciudad comienza la temporada 4?",
answers:["Roma","Londres","París","Milán"],
correct:2
}

];

let current=0;
let score=0;

const progress=document.getElementById("progress");
const question=document.getElementById("question");
const answers=document.getElementById("answers");
const result=document.getElementById("result");
const next=document.getElementById("next");

function cargarPregunta(){

result.textContent="";
next.style.display="none";

progress.textContent = `Pregunta ${current+1} de ${quiz.length}`;
question.textContent = quiz[current].question;

answers.innerHTML="";

quiz[current].answers.forEach((texto,index)=>{

const btn=document.createElement("button");
btn.className="quiz-option";
btn.textContent=texto;

btn.onclick=()=>responder(index);

answers.appendChild(btn);

});

}

function responder(index){

document.querySelectorAll(".quiz-option").forEach(b=>b.disabled=true);

if(index===quiz[current].correct){

score++;
result.textContent="✨ ¡Correcto!";
result.style.color="#c9a45c";

}else{

result.textContent=`La respuesta correcta era: ${quiz[current].answers[quiz[current].correct]}`;
result.style.color="#ff8b8b";

}

next.style.display="inline-block";

}

next.onclick=()=>{

current++;

if(current<quiz.length){

cargarPregunta();

}else{

progress.textContent="RESULTADO";
question.textContent=`Obtuviste ${score} de ${quiz.length}`;

answers.innerHTML="";

result.innerHTML="¡Sos oficialmente parte del Upper East Side! 💋";
result.style.color="#c9a45c";

next.style.display="none";

}

};

cargarPregunta();

});