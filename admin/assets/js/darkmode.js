document.addEventListener('DOMContentLoaded', function(){

    const toggle =
    document.getElementById('darkToggle');

    if(
        localStorage.getItem('darkMode')
        === 'enabled'
    ){

        document.body.classList.add(
            'dark-mode'
        );
    }

    if(toggle){

        toggle.addEventListener(
            'click',
            function(){

                document.body.classList.toggle(
                    'dark-mode'
                );

                if(
                    document.body.classList.contains(
                        'dark-mode'
                    )
                ){

                    localStorage.setItem(
                        'darkMode',
                        'enabled'
                    );

                }else{

                    localStorage.setItem(
                        'darkMode',
                        'disabled'
                    );

                }

            }
        );

    }

});