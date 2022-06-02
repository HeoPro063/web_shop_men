<template>
  <div>
      <nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">Admin Shop Men</span>
				</a>
				<ul class="sidebar-nav">
					<div class="accordion" id="accordionExample">
						<div class="accordion-item" v-for="(item, index) in dataSidebar" :key="index">
							<button class="accordion-button collapsed dashboard" type="button" data-bs-toggle="collapse"
								:data-bs-target="`#flush-collapseOne-${index}`" aria-expanded="false"
								:aria-controls="`flush-collapseOne-${index}`">
								{{item.title}}
							</button>
							<div :id="`flush-collapseOne-${index}`" class="accordion-collapse collapse"
								aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<ul class="list-unstyled ps-3">
										<li class="sidebar-item ps-3" v-for="(itemChildren, indexChildren) in item.dataItem" :key="indexChildren">
											<a class="sidebar-link" :href="baseUrl(itemChildren.url)">
												<i class="text-primary" :data-feather="itemChildren.icon"></i> <span
													class="align-middle">{{itemChildren.title}}</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</ul>
			</div>
		</nav>
  </div>
</template>

<script>
export default {
	data() {
		return {
			dataSidebar: [
				{
					title: 'Dashboard',
					dataItem: [
						{
							title: 'Home',
							icon: 'home',
							url: 'dashboard'
						}
					]
				},
				{
					title: 'Category',
					dataItem: [
						{
							title: 'List Categories',
							icon: 'list',
							url: 'list-category'
						},
						{
							title: 'Add Category',
							icon: 'plus-square',
							url: 'category/create'
						}
					]
				},
				{
					title: 'Color',
					dataItem: [
						{
							title: 'List Colors',
							icon: 'list',
							url: 'list-color'
						},
						{
							title: 'Add Color',
							icon: 'plus-square',
							url: 'color/create'
						}
					]
				}
				,
				{
					title: 'Size',
					dataItem: [
						{
							title: 'List Sizes',
							icon: 'list',
							url: 'list-size'
						},
						{
							title: 'Add Size',
							icon: 'plus-square',
							url: 'size/create'
						}
					]
				}
				,
				{
					title: 'Promotion',
					dataItem: [
						{
							title: 'List Promotion',
							icon: 'list',
							url: 'list-promotion'
						},
						{
							title: 'Add Promotion',
							icon: 'plus-square',
							url: 'promotion/create'
						}
					]
				},
				{
					title: 'Role',
					dataItem: [
						{
							title: 'List Role',
							icon: 'list',
							url: 'list-role'
						},
						{
							title: 'Add Promotion',
							icon: 'plus-square',
							url: 'role/create'
						}
					]
				},
				{
					title: 'Product',
					dataItem: [
						{
							title: 'List product',
							icon: 'list',
							url: 'list-product'
						},
						{
							title: 'Add Product',
							icon: 'plus-square',
							url: 'product/create'
						}
					]
				}
			]
		}
	}

};
</script>

<style>
</style>