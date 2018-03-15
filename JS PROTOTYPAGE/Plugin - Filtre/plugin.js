(function(){

    this.MyPlugin = function () {
        

    }
    
    MyPlugin.prototype.exe = function(element){
        
         var filtering = element.target.getAttribute('data-filter').slice(0 , element.target.getAttribute('data-filter').indexOf(":"));
        var filter_cibling = element.target.value;
        var filter_value = element.target.checked;        
        var elements_to_modify = document.querySelectorAll('.item');
        
        
        for( var element_to_modify of elements_to_modify)
        {
            var ele_cat;
            
            switch(filtering){
                case "category":
                    ele_cat = element_to_modify.getAttribute('data-category');
                    break;
                case "year":
                    ele_cat = element_to_modify.getAttribute('data-year');
                    break;
            }
            
            if(ele_cat == filter_cibling)
            {
                if(filter_value==false)
                {
                    element_to_modify.setAttribute('style' , 'display:none;');
                }
                else
                {
                   element_to_modify.setAttribute('style' , 'display:block;');
                }
            }        
        }
        
        };
    
    MyPlugin.prototype.set_default_filter = function(e , filters){
        console.log(filters);
        e.preventDefault();
        for( let filter of filters)
        {
            filter.checked = true;
        }
        
        for(var item of document.querySelectorAll('.item'))
        {
            item.setAttribute('style' , 'display:block;');
        }
    };
})();