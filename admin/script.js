$(document).ready(function (e) {
    //AjaxImg
    var files = null;
    var myModal = $("#myModal");
    var myModalArticle = $('#myModalArticle');
    var choosCategorySite;

    $('.optionFilter').on('click',function(){
        this.setAttribute('checked',this.checked);
        console.log( $(this) );
        console.log( $('input[name=optionFilter]:checked').val() );
    });

    $('.categorySiteCreate').on('change',function(){
        choosCategorySite = ($(".categorySiteCreate option:selected").text());
    });

    $('.formDownloadImgCreate .upload').on('change', function () {
        files = this.files;
        console.log(file);
    });

    $('.uploadSend').on('click', function (e) {


        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData();
        $.each(files, function (key, value) {
            formData.append(key, value);
        });
        $.ajax({
            url:"../components/uploadImg.php?uploadfiles",
            type:"POST",
            data:data,
            dataType:"json",
            processData: false,
            contentType: false,
            success:function (res) {
                console.log(res);
                if(typeof res.error==="undefined"){
                    var files_path = res.files;
                    $.each(files_path, function (key, value) {
                        $('.media-all').append("<div class='item-Img'><img src='"+value+"'><span class='delImg'>X</span></div>");
                    });
                } else {
                    console.log("Ошибка ответа сервера: "+res.error);
                }
            },
            error:function (jqXHR, textStatus, errorThrown) {
                console.log("Ошибка Ajax запроса: "+textStatus);
            }
        })
    })

    $('.item a').on('click', function (e) {
        e.preventDefault();
        navTabs($(this), $(".wrap-section"));
    });

    $('.media-item a').on('click', function (e) {
        e.preventDefault();
        navTabs($(this), $(".media-wrap-section"));
    });

    $('.btnText-btn').on('click', function (e) {
        e.preventDefault();
        var action = $(this).data("action"),
            aValueArgument = $(this).val(),
            aShowDefaultUI = false;
        if(action=="insertImage"){
            //popap path
            aValueArgument = "../uploads/150314846514562633.jpg";
        }
        document.execCommand(action, aShowDefaultUI, aValueArgument);
    });

    $('.save').on('click', function (e) {
        e.preventDefault();
        var headline = $('.headlineArticleInput').val();
        var content = $('.wrap-section-textarea').text();
        var category = choosCategorySite;
        var tag = $('.wrap-section-input-tag').val();
        var author = $('.wrap-section-input-author').val();
        var filter_category = $('input[name=optionFilter]:checked').val();

        if (headline) {
            if (content){
                sendPost(headline, category, tag, content, author, filter_category);
            } else {
                $('.wrap-section-textarea').text("Vvedite text");
            }
        } else {
            $('.headlineArticleInput').val('Zapolni')
        }
    });

    $('.save-pages').on('click', function (e) {
        e.preventDefault();
        var name = $('.alias').val().toLowerCase();
        var content = $('.wrap-section-textarea-pages').text();
        var alias = Alias(name);
        if (name) {
            if (content){
                sendPostPages(name, content, alias);
            } else {
                $('.wrap-section-textarea-pages').text("Vvedite text");
            }
        } else {
            $('.alias').val('Zapolni')
        }
    });

    $('.save-category').on('click', function (e) {
        e.preventDefault();
        var name = $('.aliasCat').val().toLowerCase();
        var alias = Alias(name);
        if (name) {
            sendPostCategories(name, alias)
        } else {
            $('.aliasCat').val('Zapolni')
        }
    });

    $('.wrap-section-content').on('click', '.delete', function (e) {
        deleteTitle($(this).closest(".wrap-section-content-name").data('id'));
    });

    $('.wrap-section-content-pages').on('click', '.delete', function (e) {
        deletePages($(this).closest(".wrap-section-content-name").data('id'));
    });

    $('.wrap-section-content-category').on('click', '.delete', function (e) {
        deleteCategories($(this).closest(".wrap-section-content-name").data('id'));
    });

    $('.wrap-section-content').on('click', '.rename', function (e) {
        var _this = $(this).closest(".wrap-section-content-name"),
            id = _this.data('id'),
            name = _this.find('p').text();
        if(_this.hasClass("renameSend")){
            renameTitle(name, id);
            _this.removeClass("renameSend");
            _this.find('p').attr("contenteditable", "false");
            $(this).text('rename');
        } else {
            _this.addClass("renameSend");
            _this.find('p').attr("contenteditable", "true");
            $(this).text('save');
        }
    });

    $('.modal_window__pagesRedact').on('click', '.save_page', function (e) {
        e.preventDefault();
        var _this = $(this).closest(myModal);
        var id = _this.attr('data-id');
        var name = $(".input_name").val();
        var alias = Alias(name);
        var content = $(".page_content").text();
        console.log(id, _this);
        redactPages(name, alias, content, id);
        myModal.removeClass('showBlock');
        myModal.attr('data-id', '0');
    });

    $('.modal_window__pagesRedact').on('click', '.cancel_page', function (e) {
        e.preventDefault();
        myModal.removeClass('showBlock');
        $(".input_name").val('');
        $(".page_content").text('');
        myModal.attr('data-id', '0');
        listPages();
    });

    $('.wrap-section-content-pages').on('click', '.redactPage', function (e) {
        e.preventDefault();
        var _this = $(this).closest(".wrap-section-content-name");
        var id = _this.data('id');
        // var content = _this.data('content');
        // var name = _this.find('p').text();
        myModal.addClass('showBlock');
        myModal.attr('data-id', id);

        getIdPages(id);
    });

    $('.modal_window__articleRedact').on('click', '.save_article', function (e) {
        e.preventDefault();
        var _this = $(this).closest(myModalArticle);
        var article_id = _this.attr('data-id');
        var headline = $(".headlineArticleInput").val();
        var author = $(".wrap-section-input-author").val();
        var tag = $(".wrap-section-input-tag").val();
        var content = $(".article_content").text();
        var category = $(".categorySiteModal").val();
        var filter_category = $('input[name=optionFilterModal]').filter('[checked]').val();
        redactArticle(headline, category, tag, content, author, filter_category, article_id)
        myModalArticle.removeClass('showBlock');
        myModalArticle.attr('data-id', '0');
    });

    $('.modal_window__articleRedact').on('click', '.cancel_article', function (e) {
        e.preventDefault();
        myModalArticle.removeClass('showBlock');

    });

    $('.wrap-section-content').on('click', '.redactArticle', function (e) {
        e.preventDefault();
        var _this = $(this).closest(".wrap-section-content-name");
        var id = _this.data('id');
        myModalArticle.addClass('showBlock');
        myModalArticle.attr('data-id', id);
        getIdArticles(id);
    });

    $('.wrap-section-content-category').on('click', '.rename', function (e) {
        var _this = $(this).closest(".wrap-section-content-name"),
            id = _this.data('id'),
            name = _this.find('p').text(),
            alias = Alias(name);
        if(_this.hasClass("renameSend")){
            renameCategory(name, id, alias);
            _this.removeClass("renameSend");
            _this.find('p').attr("contenteditable", "false");
            $(this).text('rename');
        } else {
            _this.addClass("renameSend");
            _this.find('p').attr("contenteditable", "true");
            $(this).text('save');
        }
    });

    function sendPost(headline, category, tag, content, author, filter_category){
        $.ajax({
            url:"../components/addArticle.php",
            type:"POST",
            data:{headline:headline, category:category, tag:tag, content:content, author:author, filter_category:filter_category},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                $('.headlineArticleInput').val("");
                $('.wrap-section-textarea').text("");
                $('.wrap-section-input-tag').val("");
                $('.wrap-section-input-author').val("");
                $('input[name=optionFilter]').prop('checked', false);
                $('.categorySiteCreate').prop('selectedIndex', 0);

                uploadFile(data.article_id);
            }
        })
    }

    function uploadFile(article_id) {
        var formData = new FormData;

        formData.append('article_id', article_id);

        $.each(files, function (index, file) {
            formData.append('img', file, file.name);
        });

        $.ajax({
            url:"../components/addArticleImg.php",
            type:"POST",
            contentType: false,
            processData: false,
            data:formData,
            success: function () {
                $('.formDownloadImgCreate .upload').val('');
                files = null;
                // listArticles();
            },
            error: function (e) {
                console.log(e);

                $('.formDownloadImgCreate .upload').val('');
                files = null;
            }
        })
    }

    function sendPostPages(name, content, alias){
        $.ajax({
            url:"../components/addPages.php",
            type:"POST",
            data:{name:name, content:content, alias:alias},
            dataType:'html',
            success:function (data) {
                alert("Save");
                $('.alias').val("");
                $('.wrap-section-textarea-pages').text("");
                listPages();
            }
        })
    }
    function sendPostCategories(name, alias){
        $.ajax({
            url:"../components/addCategory.php",
            type:"POST",
            data:{name:name, alias:alias},
            dataType:'html',
            success:function (data) {
                alert("Save");
                //$('.aliasCat').val("");
                listCategory();
            }
        })
    }
    function listArticles(){
        $.ajax({
            url:"../components/getAllArticles.php",
            type:"POST",
            data:{},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                $('.wrap-section-content').empty();
                for(var i = 0; i<data.length; i++){
                    $('.wrap-section-content').append("<div data-id='"+data[i].article_id+"' class='wrap-section-content-name'><p>"+data[i].headline+"</p><div class='tools'><span class='redact redactArticle'>redact</span><span class='delete'>X</span></div></div>")
                }
            }
        })
    };
    function listPages(){
        $.ajax({
            url:"../components/pages.php",
            type:"POST",
            data:{},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                //console.log(data);
                $('.wrap-section-content-pages').empty();
                for(var i = 0; i<data.length; i++){
                    $('.wrap-section-content-pages').append("<div data-id='"+data[i].id+"' data-content='"+data[i].content+"' class='wrap-section-content-name'>" +
                        "<p>"+data[i].name+"</p><a href=\"#\">"+data[i].alias+"</a><div class='tools'><span class='redact redactPage'>redact</span>" +
                        "<span class='delete'>X</span></div></div>")
                }
            }
        })
    };
    function listCategory(){
        $.ajax({
            url:"../components/categories.php",
            type:"POST",
            data:{},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                $('.categorySite').empty();
                $('.wrap-section-content-category').empty();
                for(var i = 0; i<data.length; i++){
                    $('.wrap-section-content-category').append("<div data-id='"+data[i].id+"'class='wrap-section-content-name'>" +
                        "<p>"+data[i].name+"</p>" +
                        "<a href=\"#\">"+data[i].alias+"</a>" +
                        "<div class='tools'><span class='rename'>rename</span><span class='delete'>X</span></div></div>");
                    $('.categorySite').append("<option data-id='"+data[i].id+"' value='"+data[i].name+"' class='wrap-section-content-name-category'>"+data[i].name+"</option>")
                }
            }
        })
    };
    function listImg(){
        $.ajax({
            url:"../components/listImg.php",
            type:"POST",
            data:{},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                $('.media-all').empty();
                for(var i = 0; i<data.length; i++){
                    $('.media-all').append("<div class='item-Img'><img src='"+data[i].path+"' data-id='"+data[i].id+"'><span class='delImg'>X</span></div>");
                }
            }
        })
    };
    function deleteTitle(id){
        $.ajax({
            url:"../components/delete.php",
            type:"POST",
            data:{id:id},
            dataType:'html',
            success:function () {
                alert('delete');
                listArticles();
            }
        })
    };
    function deletePages(id){
        $.ajax({
            url:"../components/deletePages.php",
            type:"POST",
            data:{id:id},
            dataType:'html',
            success:function () {
                alert('delete');
                listPages();
            }
        })
    };
    function deleteCategories(id){
        $.ajax({
            url:"../components/deleteCategories.php",
            type:"POST",
            data:{id:id},
            dataType:'html',
            success:function () {
                alert('delete');
                listCategory();
            }
        })
    };
    function renameTitle(name, id){
        $.ajax({
            url:"../components/rename.php",
            type:"POST",
            data:{name:name, id:id},
            dataType:'html',
            success:function () {
                alert('Change');
                listArticles();
            }
        })
    };
    function getIdPages(id){
        $.ajax({
            url:"../components/getIdPage.php",
            type:"POST",
            data:{id:id},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                $(".input_name").val(data.name);
                $(".page_content").text(data.content);
            }
        })
    };
    function getIdArticles(id){
        $.ajax({
            url:"../components/getIdArticles.php",
            type:"POST",
            data:{id:id},
            dataType:'html',
            success:function (data) {
                data = JSON.parse(data);
                $(".headlineArticleInput").val(data.headline);
                $(".wrap-section-input-author").val(data.author);
                $(".wrap-section-input-tag").val(data.tag);
                $(".article_content").text(data.content);
                $('input[name=optionFilterModal]').filter('[value='+data.filter_category+']').attr('checked', true);
                $('.categorySiteModal').val(data.category);
            }
        })
    };
    function redactPages(name, alias, content, id){
        $.ajax({
            url:"../components/redactPages.php",
            type:"POST",
            data:{name:name, alias:alias, content:content, id:id},
            dataType:'html',
            success:function () {
                alert('Change');
                listPages();
            }
        })
    };
    function redactArticle(headline, category, tag, content, author, filter_category, article_id){
        $.ajax({
            url:"../components/redactArticle.php",
            type:"POST",
            data:{headline:headline, category:category, tag:tag, content:content, author:author, filter_category:filter_category, article_id:article_id},
            dataType:'html',
            success:function () {
                alert('Change');
                listArticles();
            }
        })
    };
    function renameCategory(name, id, alias){
        $.ajax({
            url:"../components/renameCategory.php",
            type:"POST",
            data:{name:name, id:id, alias:alias},
            dataType:'html',
            success:function () {
                alert('Change');
                listCategory();
            }
        })
    };
    function navTabs(_this, container){
        var dir = _this.attr('href').replace('#', "");
        var item = _this.parent();
        var selectSection = container.filter("[data-target="+dir+"]");
        item.add(selectSection).addClass('active').siblings().removeClass("active");
        if (dir=="titleAll") listArticles();
    };
    function Alias(name){
        var arr1 = name.split('');
        var arrEnglish = ["a", "b", "v", "g", "d", "e", "e", "zch", "z", "i", "yi", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "ts", "ch", "sh", "shch", "y", "y", "e", "yu", "ya", "-", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "c", "w", "q", "j", "x"];
        var arrRuss = ["а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ы", "ь", "э", "ю", "я", " "];
        var alias = "";
        for(var i = 0; i<arr1.length; i++){
            var index = arrRuss.indexOf(arr1[i]);
            var indexEng = arrEnglish.indexOf(arr1[i]);
            if (index == -1) {
                if (indexEng == -1) continue;
                alias += arr1[i];
            } else {
                alias += arrEnglish[index];
            }

        }
        return alias;
    };
    listArticles();
    listPages();
    listImg();
    listCategory();
});