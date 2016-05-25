<script type="text/ng-template" id="modal.html">
  <div class="modal-header mymodal">
    <h4 class="text-center" ng-bind="product.name"></h4>        
  </div>
                  
  <div class="modal-body">
    <div class="row">
      <div class="col-xs-5 col-lg-offset-1">
        <div class="imagecontainer">
          <img ng-src="@{{ product.image }}" 
               class="img-responsive pointer"
               ng-click="newTab(product.image)">
        </div>
      </div>
      <div class="col-xs-6 contentwrapper">
          <p style="font-size: 1.7rem"><b>รายละเอียด:</b> @{{ product.content}}</p>
          <p ng-hide="thumbnails.length == 0" ng-bind="product.property" style="font-size: 1.7rem"></p>
        <div class="row">
          <div class="col-lg-4" ng-repeat="thumbnail in thumbnails">
            <img ng-src="@{{ thumbnail.thumbnail_path }}" 
             class="img-responsive pointer"
             tooltip-html-unsafe="@{{ thumbnail.name }}"
             ng-click="newTab(thumbnail.path)">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button class="btn btn-primary" ng-click="ok()">Close</button>
  </div>
</script>