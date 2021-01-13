
   /*Indicateur de coordonateur filière
===========================================*/
        //new Morris.Line({
    Morris.Donut({
        //new Morris.Bar({
        element: 'indicateur1',
        data: [
            {value: 15, label: 'Langues et Techniques d Expression'},
            {value: 20, label: 'Mathématiques I'},
            {value: 15, label: 'Architecture des Ordinateurs'},
            {value: 10, label: 'Algorithmique et Programmation'}
        ],
        formatter: function (x) { return x + "%"}
    }).on('click', function(i, row){
        console.log(i, row);
    });


        //new Morris.Line({
    Morris.Donut({
        //new Morris.Bar({
        element: 'indicateur3',
        data: [

            {value: 70, label: 'Programmation Orientés objet'},
            {value: 15, label: 'Systèmes d Exploitation et Réseaux informatiques'},
            {value: 40, label: 'Système d Information et Bases de Données'},
            {value: 50, label: 'Langues et Techniques de Communication'}
        ],
        formatter: function (x) { return x + "%"}
    }).on('click', function(i, row){
        console.log(i, row);
    });


        //new Morris.Line({
    Morris.Donut({
        //new Morris.Bar({
        element: 'indicateur5',
        data: [
            {value: 70, label: 'Mathématiques appliquées'},
            {value: 15, label: 'Développement Web'},
            {value: 30, label: 'Systèmes et Réseaux Informatiques'},
            {value: 50, label: 'Préparation à la vie active'}
        ],
        formatter: function (x) { return x + "%"}
    }).on('click', function(i, row){
        console.log(i, row);
    });


        //new Morris.Line({
    Morris.Donut({
        //new Morris.Bar({
        element: 'indicateur7',
        data: [
            {value: 80, label: 'Administration et Sécurité des Réseaux'},
            {value: 15, label: 'Services Réseaux'},
            {value: 15, label: 'Projet de fin d études'},
            {value: 30, label: 'Stage Techniques'}
        ],
        formatter: function (x) { return x + "%"}
    }).on('click', function(i, row){
        console.log(i, row);
    });
   /*Indicateur de coordonateur filière
    ===========================================*/
   /*Indicateur de coordonateur module
    ===========================================*/

   //new Morris.Line({
   Morris.Donut({
       //new Morris.Bar({
       element: 'indicateur2',
       data: [
           {value: 70, label: 'Programmation Orientés objet'},
           {value: 15, label: 'Systèmes d Exploitation et Réseaux informatiques'},
           {value: 50, label: 'Architecture des Ordinateurs'},
           {value: 50, label: 'Langues et Techniques de Communication'}
       ],
       formatter: function (x) { return x + "%"}
   }).on('click', function(i, row){
       console.log(i, row);
   });


   //new Morris.Line({
   Morris.Donut({
       //new Morris.Bar({
       element: 'indicateur4',
       data: [
           {value: 70, label: 'Programmation Orientés objet'},
           {value: 30, label: 'Systèmes d Exploitation et Réseaux informatiques'},
           {value: 15, label: 'Système d Information et Bases de Données'},
           {value: 30, label: 'Langues et Techniques de Communication'}
       ],
       formatter: function (x) { return x + "%"}
   }).on('click', function(i, row){
       console.log(i, row);
   });


   //new Morris.Line({
   Morris.Donut({
       //new Morris.Bar({
       element: 'indicateur6',
       data: [
           {value: 75, label: 'Mathématiques appliquées'},
           {value: 15, label: 'Développement Web'},
           {value: 15, label: 'Systèmes et Réseaux Informatiques'},
           {value: 45, label: 'Préparation à la vie active'}
       ],
       formatter: function (x) { return x + "%"}
   }).on('click', function(i, row){
       console.log(i, row);
   });


   //new Morris.Line({
   Morris.Donut({
       //new Morris.Bar({
       element: 'indicateur8',
       data: [
           {value: 65, label: 'Administration et Sécurité des Réseaux'},
           {value: 15, label: 'Services Réseaux'},
           {value: 35, label: 'Projet de fin d études'},
           {value: 40, label: 'Stage Techniques'}
       ],
       formatter: function (x) { return x + "%"}
   }).on('click', function(i, row){
       console.log(i, row);
   });
   /*Indicateur de coordonateur module
    ===========================================*/

