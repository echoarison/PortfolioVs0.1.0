function tradutor(value,value2) {
    var index, portfolio, sac, sobre, susten;

    value2 = parseInt(value2);

    if(value2 == 1){

        caminho = "./";

    }else{
        caminho = "../";
    }

    document.getElementsByClassName('lenguagem')[0].style.backgroundImage = 'url("'+ caminho +'Img/Icones/brasil.jpg")';
    
    //guardando valores
    titulo = document.getElementsByClassName('tituloEnglish');
    texto = document.getElementsByClassName('textEng');
    tradUlT = document.getElementsByClassName('txEng');

    //guardando Texto
    index = new Array(
        'Your Project',
        'We do the Survey',
        'We ship to Developers',
        'SysMade is always open to all types of project ideas, as we are here to give life and style to them.',
        'We always do the necessary surveys to bring or even improve the ideas of our customers, in addition to also avoiding future problems.',
        'When we finish the documentation part we send it to our team of developers to start creating the system or website faster.',
        'Windows and Linux executables',
        'Systems Optimization',
        'Others',
        'Changes',
        'Transitions',
        'Out of stock',
        'Member Login',
        'Password:',
        'I forgot the password!',
        'Log in',
        'No Discount',
        'Close Business',
        'Go to the login page and create an account!'

    );

    portfolio = new Array(
        'Project',
        'Team Dev',
        'Social Model',
        'Site Models was developed for a client who wanted a social network of beginners to post their photos to be analyzed by her company, being creative and without the use of filters only the natural beauty brought to the world.',
        'Anime Reviwes is a site that has the focus to be a point of criticism of various Japanese animations, news about great works in the otaku world and always give tips on sites to be able to watch their anime. Outside the users can leave their comments and likes.',
        'Four hits is a site that focuses on 4 musical genres which is rock, country, rap and pop. Each week talks about 4 artists from each musical genre, explaining about the origin story, the clips, composed songs and random news about the world of music.',
        'View'
    )

    sac = new Array(
        'Form',
        'Doubts',
        'Name:',
        'E-mail:',
        'Your Doubt or Opinion:',
        'Sumbit',
        'What forms of contact?',
        "If I can't get in contact, what do I do?",
        'Send an email to our SAC, sac.sysmade@gmail.com',
        'What is the payment method?',
        'Credit or debit',
    );

    susten = new Array(
        'World Value',
        'We are a company 100% concerned with the preservation of the environment and, for this reason, we have adopted the methodology of T.I Verde that aims to adopt a set of strategies to reduce the negative impact on the environment. One of our goals for the coming year is to obtain international certification ISO 14001, which is responsible for measuring the impact of certain businesses on the environment. Below we list some of the numerous strategies we have adopted.',
        'Company Strategy',
        'Our server is located in a strategic place in order to save physical space and energy;',
        'We only use equipment that consumes less energy and we use them consciously, avoiding keeping them connected unnecessarily;',
        'We advise our team to reduce unnecessary paper use whenever possible by replacing its use. To exchange information, for example, we use applications such as email, Skype, WhatsApp etc;',
        'We use cloud services whenever possible, thus avoiding unnecessary equipment purchases and wasting resources;',
        'We use an intuitive intranet that dramatically reduces resources and spending on printing, saving several trees.'
    );
    
    sobre = new Array(
        'SysMade Headquarters',
        'The company was created in 2020, by seven students, who met at Etec Basilides de Godoy in the Systems Development course, all with the aim of improving their knowledge, learning new things and experimenting with new perspectives. In the midst of the difficulties that the job market imposes, they decided to create a company that was not only aiming at profits, but rather, to expand and apply their business knowledge obtained in the course.',
        'Company vision',
        "One day we seek to become a reference company in the systems development market, offering safe work and with maximum agility in the creation of projects, without losing its quality. With the intention of amplifying the company's visibility, conquering the long-awaited space in the market as one of the first options in systems development",
        'Company values',
        'We prioritize the safety and satisfaction of our customers, always working in a transparent, agile, effective, ethical manner. In search of results, innovation, with maximum quality and the best technological resources in our systems.',
        'Company mission',
        "Our mission is very simple, we are focused on developing good systems as close to what the client asked for, because sometimes the client asked for something and we who are the professionals, realize that executing in that way may have errors in the future, so we will always see other perspectives, but never leave the client's idea. In addition to also focusing on maximum possible safe systems in the reality in question and always optimizing to the maximum."
    );



    switch (value) {

        case 1:

            if (titulo[0].innerHTML == "Seu Projeto") {

                alert("Successful translation !!!");

                //comoTrabalhamos
                titulo[0].innerHTML = index[0];
                titulo[1].innerHTML = index[1];
                titulo[2].innerHTML = index[2];

                texto[0].innerHTML = index[3];
                texto[1].innerHTML = index[4];
                texto[2].innerHTML = index[5];

                //tabelaPreco
                titulo[3].innerHTML = index[6];
                titulo[4].innerHTML = index[7];
                texto[3].innerHTML = index[8];
                texto[4].innerHTML = index[9];
                texto[5].innerHTML = index[10];
                texto[6].innerHTML = index[11];

                tradUlT[0].innerHTML = index[16];
                tradUlT[1].innerHTML = index[16];
                tradUlT[2].innerHTML = index[16];
                tradUlT[3].innerHTML = index[17];
                tradUlT[4].innerHTML = index[17];
                tradUlT[5].innerHTML = index[17];

                tradUlT[6].innerHTML = index[16];
                tradUlT[7].innerHTML = index[16];
                tradUlT[8].innerHTML = index[16];
                tradUlT[9].innerHTML = index[17];
                tradUlT[10].innerHTML = index[17];
                tradUlT[11].innerHTML = index[17];

                tradUlT[12].innerHTML = index[16];
                tradUlT[13].innerHTML = index[16];
                tradUlT[14].innerHTML = index[16];
                tradUlT[15].innerHTML = index[17];
                tradUlT[16].innerHTML = index[17];
                tradUlT[17].innerHTML = index[17];

                //localizacaoContatoLogin
                titulo[5].innerHTML = index[12];
                texto[7].innerHTML = index[13];
                texto[8].innerHTML = index[14];
                texto[9].innerHTML = index[15];
                tradUlT[18].innerHTML = index[18];




            } else {
                location.reload();
            }

            break;
        
        case 2:

            if (texto[0].innerHTML == "Projeto") {

                alert("Successful translation !!!");

                //botoes nav
                texto[0].innerHTML = portfolio[0];
                texto[1].innerHTML = portfolio[1];

                //projetoFeito
                titulo[0].innerHTML = portfolio[2];
                texto[2].innerHTML = portfolio[3];
                texto[3].innerHTML = portfolio[6];

                texto[4].innerHTML = portfolio[4];
                texto[5].innerHTML = portfolio[6];

                texto[6].innerHTML = portfolio[5];
                texto[7].innerHTML = portfolio[6];




            }else{
                location.reload();
            }    
            
        break;
        
        case 3:

            if(texto[0].innerHTML == "Formulário"){

                alert("Successful translation !!!");

                //botoesNav
                texto[0].innerHTML = sac[0];
                texto[1].innerHTML = sac[1];

                //formulario
                texto[2].innerHTML = sac[2];
                texto[3].innerHTML = sac[3];
                texto[4].innerHTML = sac[4];
                texto[5].innerHTML = sac[5];

                //duvidas
                titulo[0].innerHTML = sac[6];
                titulo[1].innerHTML = sac[7];
                texto[6].innerHTML = sac[8];
                titulo[2].innerHTML = sac[9];
                texto[7].innerHTML = sac[10];


            }else{
                location.reload();
            }

        break;

        case 4:

            if(titulo[0].innerHTML == "Valor Ao Mundo"){

                alert("Successful translation !!!");

                //sustentabilidade
                titulo[0].innerHTML = susten[0];
                texto[0].innerHTML = susten[1];

                titulo[1].innerHTML = susten[2];
                texto[1].innerHTML = susten[3];
                texto[2].innerHTML = susten[4];
                texto[3].innerHTML = susten[5];
                texto[4].innerHTML = susten[6];
                texto[5].innerHTML = susten[7];

            }else{
                location.reload();
            }

        break;

        case 5:

            if(titulo[0].innerHTML == "Sede Da SysMade"){

                alert("Successful translation !!!");
                
                //sobre empresa
                titulo[0].innerHTML = sobre[0];
                texto[0].innerHTML = sobre[1];
                titulo[1].innerHTML = sobre[2];
                texto[1].innerHTML = sobre[3];
                titulo[2].innerHTML = sobre[4];
                texto[2].innerHTML = sobre[5];
                titulo[3].innerHTML = sobre[6];
                texto[3].innerHTML = sobre[7];

            }else{
                location.reload();
            }

        break;    

        default:
            location.reload();
        break;
    }

}