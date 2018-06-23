<?= $this->assets->outputCss('blog-dt-css') ?>
<?= $this->assets->outputJs('blog-dt-js') ?>

<?= $this->partial('layouts/objdb') ?>
<script type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?lang=sql"></script>

    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <span>
             <ul>
                 <li>
                     Множество ORM используют большое количество абстракций для работы с БД (мета данные, клонирование схемы бд тд.),
                     и собственно призваны облегчить разработчику жизнь, но с другой стороны это довольно сильно запутывает, и мягко говоря заставляет проводить просто титанические усилия по оптимизации SQL запросов попробую показать альтернативный подход к построению архитектуры для работы
                     с большим количеством строк с пагинацией используя при этом средства БД где ОRM играет второстепенную роль.
                 </li>
            <br>
                 <li>
                      Cмысл заключает вот в чём: - "Если обвернуть запрос во "View" и обращаться к запросу как к обычной таблице, то мы можем получить очень неплохие вкусняхи,
                            к примеру можно использовать расширения, и по полной мере использовать возможности PostgreSql ltree, dblink, postgres_fdw, file_fdw, Windows function, join lateral, pivot extension etc".
                 </li>
            <br>
            <p>
                В качестве примера будем использовать таблицы,
                информация по работе будет доступна по клику чуть выше навигационной панели с кнопками.
                Для работы с конструктором, использовать будем <a class="wrapper-blog" href="https://datatables.net/" title="https://datatables.net/">https://datatables.net/</a>.
                    В качестве реляционных примеров будем использовать <a class="wrapper-blog" href="http://www.solarix.ru/sql-dictionary-sdk.shtml" title="Лексику и морфологию Русского языка">Лексику и морфологию Русского языка</a>
            </p>
             </ul>
        </span>
        </div>
    </div>
    </div>
    <hr>
<div class="container-fluid">
    <div class="col">

        <div class="center-wrap">
            <pre><h1 class="view_name"></h1></pre>
                <div class="table-info"> </div>
                <span class="badge badge-secondary" id="response-json"  data-toggle="modal"  data-target="#modalDynamicInfo">Ответ (json)</span>
                <span class="badge badge-secondary" id="request-json"   data-toggle="modal"  data-target="#modalDynamicInfo">Запрос (json)</span>
                <div class="table-info-select"> </div>
            <div class="btn-group">
                <div class="input-group-btn">
                    
                    <button type="button" class="btn btn-default" id="sql-view"data-toggle="modal"  data-target="#modalDynamicInfo"><span class="glyphicon glyphicon-remove-circle">View (sql)</span></button>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col">
            <div class="list-group" id="list-group-table"></div>
        </div>
        <div class="col-sm-9">
            <div class="data-tbl"> </div>
        </div>
    </div>
</div>
<hr>

</div>
    <script>
    var wrapper;
    var definitionSql ='';

    nodeObjects.forEach(function (item, i, data){
        if(item.visible != false) {
            $('#list-group-table').append(
                '<li name="' + item.view_name + '" class="list-group-item d-flex list-group-item list-group-item-action justify-content-between align-items-center sm">' +
                '<small> ' + item.text + '</small>' +
                '<span class="badge badge-primary badge-pill">' + item.count + '</span>' +
                '</li>');
        }
    });

    $(document).ready(function () {

        RebuildReport(getPagingViewObject('vw_conjunction'));

        $(".list-group-item").click(function(){
           var v= $(this).attr('name');
            RebuildReport(getPagingViewObject(v));
        });

        function RebuildReport(node){
            $('#select2-query').text('');
            var parmsTableWrapper = {
                externalOpt: {
                    urlDataTable: '/objectdb/showdata',
                    urlColumnData:'/objectdb/showcol',
                    checkedUrl: '/objectdb/idsdata',
                    urlSelect2: '/objectdb/txtsrch',
                    select2Input: true,
                    tableDefault: node.view_name,
                    checkboxes: false,
                    dtFilters: true,
                    dtTheadButtons: false,
                    idName: 'id',
                    columns: node.col
                },
                dataTableOpt:
                    {
                        scrollx: true,
                        pagingType: 'simple_numbers',
                        lengthMenu: [[5,10],[5,10]],
                        displayLength: 30,
                        serverSide:true,
                        processing: true,
                        searching: false,
                        bFilter : false,
                        bLengthChange: false,
                        pageLength: 20,
                        dom: '<"top"flp>rt<"top"i><"clear"><"centered"p>'
                    },
            };

            definitionSql = node.view;

            wrapper = $('.data-tbl').DataTableWrapperExt(parmsTableWrapper);

            $('.view_name').text(node.text);
        }

        $('#modalDynamicInfo').on("show.bs.modal", function(e) {
            var value = ($(e.relatedTarget).attr('id'));
            var info = wrapper.getJsonInfo();

            if(value) {
                switch (value) {
                    case 'datatable-data':
                        object = info['dtObj'].o.debug[0].data;
                        break;
                    case 'datatable-f-ttl':
                        object = info['dtObj'].o.debug[1].recordsFiltered;
                        break;
                    case 'datatable-ttl':
                        object = info['dtObj'].o.debug[2].recordsTotal;
                        break;
                    case 'select2-query':
                        object = info['s2obj'];
                        break;
                    case 'response-json':
                        object = info['dtObj'].o;
                        break;
                    case 'request-json':
                        object = info['dtObj'].i;
                        break;
                    case 'sql-view':
                        object = definitionSql;
                        break;
                    default:
                }

                $(this).find(".modal-body").html('<pre class="prettyprint lang-sql">' + syntaxHighlight(object) + '</pre>');
            }
        });
    });

</script>
