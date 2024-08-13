var url=location.href;


if(url.indexOf("seats.php")!=-1){
    $("#buy").click(buyTickets)
    $("#checkSeats").click(checkSeats)
    $(".places").click(markPlace)
}

if(url.indexOf("performances.php")!=-1){
    getPerformances()
    $("#search").keyup(getPerformances)
}
if(url.indexOf("login.php")!=-1){
    $("#logBtn").click(showRegDiv)
    $("#regBtn").click(showLogDiv)
    $(".divLogReg p").hide()
}

if(url.indexOf("tickets.php")!=-1){
    getTickets()
}
if(url.indexOf("contact.php")!=-1){
    $(".messageDiv p").hide()
    $("#vote").click(vote)
}

if(url.indexOf("admin/index.php")!=-1){
    $("#performances").click(adminPerformances)
    $("#addPerformance").click(addPerformance)
    $("#repertoire").click(adminRepertoire)
    $("#addRepertoire").click(addRepertoire)
    $("#users").click(getUsers)
    $("#messages").click(getMessages)
    $("#poll").click(getPoll)
}

function getPoll(e){
    e.preventDefault()
    getPollRes()
}

function adminPerformances(e){
    e.preventDefault()
    getPerformancesAdmin()
}

function adminRepertoire(e){
    e.preventDefault()
    getRepertoire()
}


function showRegDiv(e){
    e.preventDefault()
    $("#logDiv").removeClass("d-none")
    $("#regDiv").addClass("d-none")
}

function showLogDiv(e){
    e.preventDefault()
    $("#logDiv").addClass("d-none")
    $("#regDiv").removeClass("d-none")
}
let errors=[]
function validate(input,regex){
    let br=0
    if(!regex.test(input.val())){
        input.addClass("border-danger")
        input.removeClass("border-success")
        input.parent().find("p").show()
        br++
    }
    else{
        input.removeClass("border-danger")
        input.addClass("border-success")
        input.parent().find("p").hide()
    }
    return br
}
function login(){
    var email=$("#email")
    var password=$("#password")

    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    var error=0

    error=validate(email,regEmail)
    error=validate(password,regPass)

    


    if(error==0){
        $.ajax({
            url:'models/login.php',
            method:"POST",
            dataType:"json",
            data:{
                "email":email.val(),
                "password":password.val(),
                "btnLogin":true
            },
            success:function(data){
                if(data=="ok"){
                    window.location.href="index.php"
                }
                else{
                    $("#messageLogin").html(data)
                }
            },
            error:function(xhr){
                var error=JSON.parse(xhr.responseText)
                let print=''
                for(let e of error){
                    print+=`${e}`
                }
                $("#messageLogin").html(print)
            }
        })
    }

    return false;
}


function getPerformances(){
    var search=$("#search").val()
    $.ajax({
        url:'models/performances.php',
        method:"get",
        dataType:"json",
        data:{
            "btn":true,
            "search":search
        },
        success:function(data){
            if(data['performances'].length!=0){
                printPerformances(data['performances'])
                printPagination(data)
            }
            else{
                $("#performances").html("<h2 class='text-primary'>There is no matching data</h2>")
            }

        },
        error:function(xhr){
            
        }
    })
}

function printPerformances(data){
    let print=''
    for(let d of data){
        print+=`<div class="col-3 performance text-center">
        <a href="performance.php?id=${d.id}">
            <img class="img-fluid" src="assets/images/${d.poster}" alt="${d.name}"/>
            <h2 class="green fs-4">${d.name}</h2>
        </a>
    </div>`
    }

    $("#performances").html(print)
}

function printPagination(data){
    let print='';
    if(data.currentPage!=1){
        print+=`<a href="#" class="page" data-id="${data.currentPage-1}">Previous</a>`
    }
    if(data.sumPages!=1){
        for(let i=1;i<=data.sumPages;i++){
            if(i<=data.sumPages){
                print+=`<a href="#" class="page links`
                if(i==data.currentPage){
                    print+=` active`
                }
                print+=`" data-id="${i}">${i}</a>`
            }
        }
    }

    if(data.currentPage!=data.sumPages){
        print+=`<a href="#" class="page" data-id="${data.currentPage+1}">Next</a>`
    }

    $("#pagination").html(print)
    $(".page").click(changePage)
}

function changePage(e){
    e.preventDefault()
    var page=this.dataset.id
    var search=$("#search").val()
    $.ajax({
        url:"models/performances.php",
        method:"get",
        dataType:"json",
        data:{
            "page": page,
            "search": search,
            "btn":true
        },
        success:function(data){
            if(data.performances.length!=0){
                printPerformances(data.performances)
                printPagination(data)
            }
            else{
                $("#performances").html("<h2 class='text-primary'>There is no matching data</h2>")
            }
        },
        error:function(xhr){
            //err
        }
    })
}

function markPlace(e){
    e.preventDefault()
    if($(this).hasClass("addToCart")){
        $(this).removeClass("addToCart")
    }
    else{
        $(this).addClass("addToCart")
    }
}
function checkSeats(){
    var seats=$(".addToCart")
    $("#buyMessage").html("")
    if(seats.length!=0){
        $("#buy").removeAttr("disabled")
        let print=''
        for(let s of seats){
            if(s.dataset.position==1){
                var position="Parterre left"
            }
            else if(s.dataset.position==2){
                var position="Parterre right"
            }
            else{
                var position="Middle"
            }
            print+=`<p>Row: <b>${s.dataset.row}</b></p>
                <p>Place: <b>${s.dataset.place}</b></p>
                <p>Position: ${position}</p>
                <hr>`
        }
        $("#seatsMessage").html(print)
    }
    else{
        $("#buy").attr("disabled","disabled")
        $("#seatsMessage").html("<h3>You have to choose seats</h3>")
    }
}
function buyTickets(){
    var seats=$(".addToCart")
    if(seats.length!=0){
        var repertoire=$("#repertoire").val()
        var seatsForSend=[]
        for(let s of seats){
            var obj={
                "idRepertoire":repertoire,
                "row":s.dataset.row,
                "place":s.dataset.place,
                "position":s.dataset.position
            }
            seatsForSend.push(obj)
        }

        
        $.ajax({
            url:'models/buyTickets.php',
            method:"POST",
            dataType:"json",
            data:{
                "tickets":seatsForSend,
                "btnBuy":true
            },
            success:function(data){
                console.log(seats)
                $("#buyMessage").html(data)
                $("#buy").attr("disabled","disabled")
                for(let s of seats){
                    s.classList.add("purchased")
                    s.classList.remove("addToCart")
                }

            },
            error:function(xhr){
                alert(JSON.parse(xhr.responseText))
            }
        })
    }
    else{
        alert("Choose seats")
    }
}


function register(){
    var email=$("#emailReg")
    var password=$("#password")
    var firstName=$("#firstName")
    var lastName=$("#lastName")
    var password=$("#pass")
    var passConf=$("#passConfirm")

    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;
    var regName=/^[A-ZZŠĐŽČĆ][a-zzšđžčć]{2,29}$/;
    var regPass=/^.{8,50}$/;
    var regPass=/^.{8,50}$/;

    var error=0

    error=validate(email,regEmail)
    error=validate(firstName,regName)
    error=validate(lastName,regName)
    error=validate(password,regPass)

    if(password.val()!=passConf.val() || password.val()==""){
        passConf.addClass("border-danger")
        passConf.removeClass("border-success")
        passConf.parent().find("p").show()
        error++
    }
    else{
        passConf.removeClass("border-danger")
        passConf.addClass("border-success")
        passConf.parent().find("p").hide()
    }

    if(error==0){
        $.ajax({
            url:'models/register.php',
            method:"POST",
            dataType:"json",
            data:{
                "firstName":firstName.val(),
                "lastName":lastName.val(),
                "email":email.val(),
                "password":password.val(),
                "passConfirm":passConf.val(),
                "btnRegister":true
            },
            success:function(data){
                    $("#messageRegister").html(data)
            },
            error:function(xhr){
                var error=JSON.parse(xhr.responseText)
                let print=''
                  for(let e of error){
                      print+=`${e}`
                  }
                $("#messageRegister").html(print)
            }
        })
    }

   

    return false;
}

function sendMessage(){

    var email=$("#email")
    var subject=$("#subject")
    var message=$("#message")

    
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regSubject=/^[\w\s]+$/;
    var error=0;
    message=message.val().split(" ")

    error+=validate(email,regEmail)
    error+=validate(subject,regSubject)
   
    if(message.length<10){
        $("#message").addClass("border-danger")
        $("#message").removeClass("border-success")
        $("#message").parent().find("p").show()
        error++;
    }
    else{
        $("#message").removeClass("border-danger")
        $("#message").addClass("border-success")
        $("#message").parent().find("p").hide()
    }
    if(error==0){
        $.ajax({
            url:'models/message.php',
            method:"POST",
            dataType:"json",
            data:{
                "email":email.val(),
                "message":message,
                "subject":subject.val(),
                "btnMessage":true
            },
            success:function(data){
                $("#alertMessage").html(data)
                $("#alertMessage").show()

            },
            error:function(xhr){
                $("#alertMessage").html(JSON.parse(xhr.responseText))
                $("#alertMessage").show()
            }
        })
    }

    return false;
}
function getTickets(){
    $.ajax({
        url:'models/getTickets.php',
        method:"POST",
        dataType:"json",
        data:{
            "ticketsBtn":true
        },
        success:function(data){
            printTickets(data)

        },
        error:function(xhr){
            $("#table").html(JSON.parse(xhr.responseText))
        }
    })
}

function printTickets(data){
    let print=''
    let br=1
    if(data.length!=0){
        print+=`
        <table class="table">
            <tr>
                <th>No</th>
                <th>Performance</th>
                <th>Date</th>
                <th>Info</th>
                <th>Price</th>
                <th class="text-center">Cancel</th>
            </tr>`

        for(let d of data){
            if(d.position==1){
                d.position="Parterre Left"
            }
            else if(d.position==2){
                d.position="Parterre Rigth"
            }
            else{
                d.position="Middle"
            }
            print+=`
                <tr>
                    <td>${br}</td>
                    <td>${d.name}</td>
                    <td>${d.datePerforming.split("-")[2]}.${d.datePerforming.split("-")[1]}</td>
                    <td>Row:${d.row} <br> Seat: ${d.place} <br> ${d.position}</td>
                    <td>${d.price}</td>
                    <td class="text-center"><a class="cancel" href="#" data-id="${d.id}"><i class="fa-solid fa-xmark text-danger fs-4"></i></a></td>
                </tr>
            `
        }

        print+=`</table>`
    }
    else{
        print=`<h2 class="text-center">There are no tickets yet!</h2>`
        $("#table").html(print)
    }


    $("#table").html(print)
    $(".cancel").click(cancelTicket)
}

function cancelTicket(e){
    e.preventDefault()
    var id=this.dataset.id
    var row=$(this).parent().parent()
    $.ajax({
        url:'models/cancelTicket.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id,
            "cancelBtn":true
        },
        success:function(data){
            row.remove()
        },
        error:function(xhr){
            $("#table").html(JSON.parse(xhr.responseText))
        }
    })
}

function vote(){
    var answer=$(".odg:checked").val()
    if(answer){
        $.ajax({
            url:"models/vote.php",
            method:"post",
            dataType:"json",
            data:{
                "id":answer
            },
            success:function(data){
                $("#obavestenje").html(data)
                $("#vote").attr("disabled","disabled")
            },
            error:function(xhr){
                $("#obavestenje").html(JSON.parse(xhr.responseText))
            }
        })
    }
    else{
        $("#obavestenje").html("You have to choose answer!")
    }

}


// ADMIN


function getUsers(e){
    e.preventDefault()
    $.ajax({
        url:'../models/getUsersAdmin.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printUsersAdmin(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function printUsersAdmin(data){
    var print=''
    print+=`<h1>Users</h1>`
    print+=`<table class="table">
            <tr>
                <th>No</th>
                <th>E-mail</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Active</th>
                <th>Registration Date</th>
            </tr>`
    let br=1;
    for(let d of data){
        print+=`<tr>
                    <td>${br++}</td>
                    <td>${d.email}</td>
                    <td>${d.firstname}</td>
                    <td>${d.lastname}</td>
                    <td>`
                    if(d.active==1){
                        print+=`Yes`
                    }
                    else{
                        print+=`No`
                    }
                print+=`</td>
                <td>${d.registrationDate}</td>
                </tr>`
    }    
        print+=`</table>`

    $("#content").html(print)

}

function getMessages(e){
    e.preventDefault()
    $.ajax({
        url:'../models/getMessagesAdmin.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printMessagesAdmin(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function printMessagesAdmin(data){
    var print=''
    print+=`<h1>Messages</h1>`
    print+=`<table class="table">
            <tr>
                <th>E-mail</th>
                <th>Title</th>
                <th>Message</th>
                <th>Date</th>
                <th class="text-center">Delete</th>
            </tr>`
    for(let d of data){
        print+=`<tr>
                    <td>${d.email}</td>
                    <td>${d.subject}</td>
                    <td>${d.message}</td>
                    <td>${d.sendingDate}</td>
                    <td class="text-center"><a href="#" class="delete" data-id="${d.id}"><i class="fa-regular fa-xmark"></i></a></td>
                </tr>`
    }    
        print+=`</table>`

    $("#content").html(print)

    $(".delete").click(deleteMessage)
}
function deleteMessage(e){
    e.preventDefault()
    var id=this.dataset.id
    var row=$(this).parent().parent()
    $.ajax({
        url:'../models/deleteMessage.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            row.remove()
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function getPerformancesAdmin(){
    $.ajax({
        url:'../models/performances.php',
        method:"GET",
        dataType:"json",
        data:{
            "btn":true
        },
        success:function(data){
            printPerformancesAdmin(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function printPerformancesAdmin(data){
    let print=`<table class="table">`

    print+=`<tr>
                <th>No</th>
                <th>Name</th>
                <th>Poster</th>
                <th>Premier</th>
                <th>Price</th>
                <th class="text-center">Update</th>
                <th class="text-center">Delete</th>
            </tr>`
    let br=(data.currentPage-1)*4+1
    for(let d of data.performances){
        print+=`<tr>
                    <td>${br++}</td>
                    <td class="col-3">${d.name}</td>
                    <td class="col-2">
                        <img class="img-fluid" src="../assets/images/${d.poster}" alt="${d.name}"/>
                    </td>
                    <td>${d.premier}</td>
                    <td>${d.price}</td>
                    <td class="text-center"><a href="#" class="update" data-id="${d.id}"><i class="fa-regular fa-pen-to-square"></i></a></td>
                    <td class="text-center"><a href="#" class="delete" data-id="${d.id}"><i class="fa-regular fa-xmark"></i></a></td>
                </tr>`
    }

    print+='</table>'

    print+=`<div id="pagination" class="text-center">`

    if(data.currentPage!=1){
        print+=`<a href="#" class="page" data-id="${data.currentPage-1}">Previous</a>`
    }
    if(data.sumPages!=1){
        for(let i=1;i<=data.sumPages;i++){
            if(i<=data.sumPages){
                print+=`<a href="#" class="page links`
                if(i==data.currentPage){
                    print+=` active`
                }
                print+=`" data-id="${i}">${i}</a>`
            }
        }
    }

    if(data.currentPage!=data.sumPages){
        print+=`<a href="#" class="page" data-id="${data.currentPage+1}">Next</a>`
    }

    print+=`</div>`


    
    $("#content").html(print)

    $(".delete").click(deletePerformance)
    $(".update").click(updatePerformance)
    
    $(".page").click(changePageAdmin)
}
function updatePerformance(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../models/getEditPerformance.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            printFormEditPerformance(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printFormEditPerformance(data){
    let print=`<h2>Edit Performance</h2>
                <form action="#" enctype="multipart/form-data">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" value="${data['name']}" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="poster">Poster</label>
                        <input type="file" id="file">
                    </div>
                    <div class="mt-2">
                        <label for="premier">Premier Date</label>
                        <input type="date" id="premier" value="${data['premier']}" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="duration">Duration</label>
                        <input type="number" id="duration" value="${data['duration']}" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description">${data['description']}</textarea>
                    </div>
                    <div class="mt-2">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" value="${data['price']}">
                    </div>
                    <div class="mt-2">
                        <input type="submit" id="update" value="Update performance" class="form-control">
                    </div>
                    <div class="mt-2">
                        <p id="messageInsert"></p>
                    </div>
                    <input type="hidden" value="${data['id']}" id="id">
                </form>`

                
    $("#content").html(print)

    
    $("#update").click(doUpdatePerformance)

}

function doUpdatePerformance(){
    var name=$("#name").val()
    var file=$("#file")[0].files[0]
    var premier=$("#premier").val()
    var duration=$("#duration").val()
    var description=$("#description").val()
    var price=$("#price").val()
    var id=$("#id").val()


    var podaciZaSlanje = new FormData()

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("file",file)
    podaciZaSlanje.append("premier",premier)
    podaciZaSlanje.append("duration",duration)
    podaciZaSlanje.append("description",description)
    podaciZaSlanje.append("price",price)
    podaciZaSlanje.append("id",id)

    $.ajax({
        url:"../models/editPerformance.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#messageInsert").html(data)
        },
        error:function(xhr){
            $("#messageInsert").html(JSON.parse(xhr.responseText))
        }
    })

    return false

}
function deletePerformance(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../models/deletePerformance.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            getPerformancesAdmin()
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function changePageAdmin(e){
    e.preventDefault()
    var page=this.dataset.id
    $.ajax({
        url:"../models/performances.php",
        method:"get",
        dataType:"json",
        data:{
            "page": page,
            "btn":true
        },
        success:function(data){
            if(data.performances.length!=0){
                printPerformancesAdmin(data)
            }
            else{
                $("#content").html("<h2 class='text-primary'>There is no matching data</h2>")
            }
        },
        error:function(xhr){
            //err
        }
    })
}

function addRepertoire(e){
    e.preventDefault()
    $.ajax({
        url:'../models/allPerformances.php',
        method:"GET",
        dataType:"json",
        data:{
            "btn":true
        },
        success:function(data){
            printFormRepertoire(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function printFormRepertoire(data){
    let print=`<h2>Add Repertoire</h2>
    <form action="#">
        <div>
            <label for="performance">Performance</label>
            <select id="idPerformance" class="form-control">
                <option value="0">Choose performance</option>`
            for(let d of data){
                print+=`<option value="${d.id}">${d.name}</option>`
            }
        print+=`</select>
        </div>
        <div class="mt-2">
            <label for="date">Date Performing</label>
            <input type="date" id="date" class="form-control">
        </div>
        <div class="mt-2">
            <input type="submit" id="add" value="Add repertoire" class="form-control">
        </div>
        <div class="mt-2">
            <p id="messageInsert"></p>
        </div>
    </form>`

    
    $("#content").html(print)

    $("#add").click(addOnRepertoire)
}

function addOnRepertoire(){
    var idPerformance=$("#idPerformance").val()
    var date=$("#date").val()
    $.ajax({
        url:'../models/addRepertoire.php',
        method:"POST",
        dataType:"json",
        data:{
            "btn":true,
            "idPerformance":idPerformance,
            "date":date
        },
        success:function(data){
            $("#messageInsert").html(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })

    return false
}

function getRepertoire(){
    $.ajax({
        url:'../models/repertoireAdmin.php',
        method:"GET",
        dataType:"json",
        data:{
            "btn":true
        },
        success:function(data){
            printRepertoire(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}

function printRepertoire(data){
    let br=1
    let print=''
    if(data.length==0){
        print="<h2>There's nothing on repertoire</h2>"
    }
    else{
        print=`<table class="table">
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Date Performing</td>
                <td>Delete</td>
            </tr>`
        for(let d of data){
            print+=`<tr>
                        <td>${br++}</td>
                        <td>${d.name}</td>
                        <td>${d.datePerforming}</td>
                        <td class="text-center"><a href="#" class="delete" data-id="${d.id}"><i class="fa-regular fa-xmark"></i></a></td>
                    </tr>`
        }
    }

    
    $("#content").html(print)
    
    $(".delete").click(deleteRepertoire)

}
function deleteRepertoire(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../models/deleteRepertoire.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            getRepertoire()
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function getPollRes(){
    $.ajax({
        url:'../models/pollRez.php',
        method:"POST",
        dataType:"json",
        data:{
            "btn":true
        },
        success:function(data){
            printPoll(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printPoll(data){
    let print="<div class='text-center'>"
    print+=`<h2 class="my-2">${data['question']}</h2>`
    for(let d of data['voting']){
        print+=`<p class="mb-2">${d.answer}: ${d.answers} answers</p>`
    }
    if(data['active']==1){
        print+=`<a href="#" id="disable" class="text-center">Disable poll</a>`
    }
    else{
        print+=`<a href="#" id="enable" class="text-center">Enable poll</a>`
    }
    print+="</div>"
    $("#content").html(print)

    $("#disable").click(disablePoll)
    $("#enable").click(enablePoll)
}
function disablePoll(e){
    e.preventDefault()
    $.ajax({
        url:"../models/disablePoll.php",
        method:"post",
        dataType:"json",
        success:function(data){
            getPollRes()
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
}
function enablePoll(e){
    e.preventDefault()
    $.ajax({
        url:"../models/enablePoll.php",
        method:"post",
        dataType:"json",
        success:function(data){
            getPollRes()
        },
        error:function(xhr){
            console.log(xhr)
        }
    })
}
function addPerformance(e){
    e.preventDefault()
    let print=`<h2>Add Performance</h2>
                <form action="#" enctype="multipart/form-data">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="poster">Poster</label>
                        <input type="file" id="file">
                    </div>
                    <div class="mt-2">
                        <label for="premier">Premier Date</label>
                        <input type="date" id="premier" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="duration">Duration</label>
                        <input type="number" id="duration" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="mt-2">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price">
                    </div>
                    <div class="mt-2">
                        <input type="submit" id="add" value="Add performance" class="form-control">
                    </div>
                    <div class="mt-2">
                        <p id="messageInsert"></p>
                    </div>
                </form>`

                
    $("#content").html(print)

    $("#add").click(addNewPerformance)
}

function addNewPerformance(){
    var name=$("#name").val()
    var file=$("#file")[0].files[0]
    var premier=$("#premier").val()
    var duration=$("#duration").val()
    var description=$("#description").val()
    var price=$("#price").val()


    var podaciZaSlanje = new FormData()

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("file",file)
    podaciZaSlanje.append("premier",premier)
    podaciZaSlanje.append("duration",duration)
    podaciZaSlanje.append("description",description)
    podaciZaSlanje.append("price",price)

    $.ajax({
        url:"../models/addPerformance.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#messageInsert").html(data)
        },
        error:function(xhr){
            $("#messageInsert").html(JSON.parse(xhr.responseText))
        }
    })


    return false
}