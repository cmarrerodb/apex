<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

	<!-- LOGO -->
	{{-- <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-dark-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="22">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="22">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-light-sm.png') }}" alt="" height="22">
            </span>
        </a>
    </div> --}}

	<button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger">
		<span class="hamburger-icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</button>

	<div data-simplebar class="sidebar-menu-scroll">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

				<li>
					<a href="javascript: void(0);">
						<i class="icon nav-icon" data-eva="grid-outline"></i>
						<span class="menu-item" data-key="t-dashboards">@lang('translation.Dashboards')</span>
						<span class="badge rounded-pill bg-primary">3</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="index" data-key="t-ecommerce">@lang('translation.Ecommerce')</a></li>
						<li><a href="dashboard-saas" data-key="t-saas">@lang('translation.Saas')</a></li>
						<li><a href="dashboard-crypto" data-key="t-crypto">@lang('translation.Crypto')</a></li>
					</ul>
				</li>

				<li class="menu-title" data-key="t-applications">@lang('translation.Applications')</li>

				<li>
					<a href="apps-calendar">
						<i class="icon nav-icon" data-eva="calendar-outline"></i>
						<span class="menu-item" data-key="t-calendar">@lang('translation.Calendars')</span>
					</a>
				</li>

				<li>
					<a href="apps-chat">
						<i class="icon nav-icon" data-eva="message-circle-outline"></i>
						<span class="menu-item" data-key="t-chat">@lang('translation.Chat')</span>
						<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">Hot</span>
					</a>
				</li>

				<li>
					<a href="apps-file-manager">
						<i class="icon nav-icon" data-eva="archive-outline"></i>
						<span class="menu-item" data-key="t-filemanager">@lang('translation.File_Manager')</span>
					</a>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="shopping-bag-outline"></i>
						<span class="menu-item" data-key="t-ecommerce">@lang('translation.Ecommerce')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="ecommerce-products" data-key="t-products">@lang('translation.Products')</a></li>
						<li><a href="ecommerce-product-detail" data-key="t-product-detail">@lang('translation.Product_Detail')</a></li>
						<li><a href="ecommerce-orders" data-key="t-orders">@lang('translation.Orders')</a></li>
						<li><a href="ecommerce-customers" data-key="t-customers">@lang('translation.Customers')</a></li>
						<li><a href="ecommerce-cart" data-key="t-cart">@lang('translation.Cart')</a></li>
						<li><a href="ecommerce-checkout" data-key="t-checkout">@lang('translation.Checkout')</a></li>
						<li><a href="ecommerce-shops" data-key="t-shops">@lang('translation.Shops')</a></li>
						<li><a href="ecommerce-add-product" data-key="t-add-product">@lang('translation.Add_Product')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="email-outline"></i>
						<span class="menu-item" data-key="t-email">@lang('translation.Email')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="email-inbox" data-key="t-inbox">@lang('translation.Inbox')</a></li>
						<li><a href="email-read" data-key="t-read-email">@lang('translation.Read_Email')</a></li>
						<li>
							<a href="javascript: void(0);">
								<span data-key="t-email-templates">@lang('translation.Templates')</span>
								<span class="badge rounded-pill badge-soft-success" data-key="t-new">@lang('translation.New')</span>
							</a>
							<ul class="sub-menu" aria-expanded="true">
								<li><a href="email-template-basic" data-key="t-basic-action">@lang('translation.Basic_Action')</a></li>
								<li><a href="email-template-alert" data-key="t-alert-email">@lang('translation.Alert_Email')</a></li>
								<li><a href="email-template-billing" data-key="t-bill-email">@lang('translation.Billing_Email')</a></li>
							</ul>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="book-outline"></i>
						<span class="menu-item" data-key="t-invoices">@lang('translation.Invoices')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="invoices-list" data-key="t-invoice-list">@lang('translation.Invoice_List')</a></li>
						<li><a href="invoices-detail" data-key="t-invoice-detail">@lang('translation.Invoice_Detail')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="briefcase-outline"></i>
						<span class="menu-item" data-key="t-projects">@lang('translation.Projects')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="projects-grid" data-key="t-p-grid">@lang('translation.Projects_Grid')</a></li>
						<li><a href="projects-list" data-key="t-p-list">@lang('translation.Projects_List')</a></li>
						<li><a href="projects-create" data-key="t-create-new">@lang('translation.Create_New')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="wifi-outline"></i>
						<span class="menu-item" data-key="t-contacts">@lang('translation.Contacts')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="contacts-grid" data-key="t-user-grid">@lang('translation.User_Grid')</a></li>
						<li><a href="contacts-list" data-key="t-user-list">@lang('translation.User_List')</a></li>
						<li><a href="contacts-profile" data-key="t-user-profile">@lang('translation.Profile')</a></li>
					</ul>
				</li>

				<li class="menu-title" data-key="t-layouts">@lang('translation.Layouts')</li>

				<li>
					<a href="layouts-horizontal">
						<i class="icon nav-icon" data-eva="browser-outline"></i>
						<span class="menu-item" data-key="t-horizontal">@lang('translation.Horizontal')</span>
					</a>
				</li>

				<li class="menu-title" data-key="t-pages">@lang('translation.Pages')</li>

				<li>
					<a href="javascript: void(0);">
						<i class="icon nav-icon" data-eva="person-done-outline"></i>
						<span class="menu-item" data-key="t-authentication">@lang('translation.Authentication')</span>
						<span class="badge rounded-pill bg-info">8</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="auth-login" data-key="t-login">@lang('translation.Login')</a></li>
						<li><a href="auth-register" data-key="t-register">@lang('translation.Register')</a></li>
						<li><a href="auth-recoverpw" data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>
						<li><a href="auth-lock-screen" data-key="t-lock-screen">@lang('translation.Lock_Screen')</a></li>
						<li><a href="auth-logout" data-key="t-logout">@lang('translation.Logout')</a></li>
						<li><a href="auth-confirm-mail" data-key="t-confirm-mail">@lang('translation.Confirm_Mail')</a></li>
						<li><a href="auth-email-verification" data-key="t-email-verification">@lang('translation.Email_verification')</a></li>
						<li><a href="auth-two-step-verification" data-key="t-two-step-verification">@lang('translation.Two_step_verification')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="cube-outline"></i>
						<span class="menu-item" data-key="t-utility">@lang('translation.Utility')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="pages-starter" data-key="t-starter-page">@lang('translation.Starter_Page')</a></li>
						<li><a href="pages-maintenance" data-key="t-maintenance">@lang('translation.Maintenance')</a></li>
						<li><a href="pages-comingsoon" data-key="t-coming-soon">@lang('translation.Coming_Soon')</a></li>
						<li><a href="pages-timeline" data-key="t-timeline">@lang('translation.Timeline')</a></li>
						<li><a href="pages-faqs" data-key="t-faqs">@lang('translation.FAQs')</a></li>
						<li><a href="pages-pricing" data-key="t-pricing">@lang('translation.Pricing')</a></li>
						<li><a href="pages-404" data-key="t-error-404">@lang('translation.Error_404')</a></li>
						<li><a href="pages-500" data-key="t-error-500">@lang('translation.Error_500')</a></li>
					</ul>
				</li>

				<li class="menu-title" data-key="t-components">@lang('translation.Components')</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="layers-outline"></i>
						<span class="menu-item" data-key="t-ui-elements">@lang('translation.UI_Elements')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="ui-alerts" data-key="t-alerts">@lang('translation.Alerts')</a></li>
						<li><a href="ui-buttons" data-key="t-buttons">@lang('translation.Buttons')</a></li>
						<li><a href="ui-cards" data-key="t-cards">@lang('translation.Cards')</a></li>
						<li><a href="ui-carousel" data-key="t-carousel">@lang('translation.Carousel')</a></li>
						<li><a href="ui-dropdowns" data-key="t-dropdowns">@lang('translation.Dropdowns')</a></li>
						<li><a href="ui-grid" data-key="t-grid">@lang('translation.Grid')</a></li>
						<li><a href="ui-images" data-key="t-images">@lang('translation.Images')</a></li>
						<li><a href="ui-lightbox" data-key="t-lightbox">@lang('translation.Lightbox')</a></li>
						<li><a href="ui-modals" data-key="t-modals">@lang('translation.Modals')</a></li>
						<li><a href="ui-offcanvas" data-key="t-offcanvas">@lang('translation.Offcanvas')</a></li>
						<li><a href="ui-rangeslider" data-key="t-range-slider">@lang('translation.Range_Slider')</a></li>
						<li><a href="ui-progressbars" data-key="t-progress-bars">@lang('translation.Progress_Bars')</a></li>
						<li><a href="ui-sweet-alert" data-key="t-sweet-alert">@lang('translation.Sweet_Alert')2</a></li>
						<li><a href="ui-tabs-accordions" data-key="t-tabs-accordions">@lang('translation.Tabs_&_Accordions')</a></li>
						<li><a href="ui-typography" data-key="t-typography">@lang('translation.Typography')</a></li>
						<li><a href="ui-video" data-key="t-video">@lang('translation.Video')</a></li>
						<li><a href="ui-general" data-key="t-general">@lang('translation.General')</a></li>
						<li><a href="ui-colors" data-key="t-colors">@lang('translation.Colors')</a></li>
						<li><a href="ui-rating" data-key="t-rating">@lang('translation.Rating')</a></li>
						<li><a href="ui-notifications" data-key="t-notifications">@lang('translation.Notifications')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="edit-2-outline"></i>
						<span class="menu-item" data-key="t-forms">@lang('translation.Forms')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="form-elements" data-key="t-form-elements">@lang('translation.Form_Elements')</a></li>
						<li><a href="form-layouts" data-key="t-form-layouts">@lang('translation.Form_Layouts')</a></li>
						<li><a href="form-validation" data-key="t-form-validation">@lang('translation.Form_Validation')</a></li>
						<li><a href="form-advanced" data-key="t-form-advanced">@lang('translation.Form_Advanced')</a></li>
						<li><a href="form-editors" data-key="t-form-editors">@lang('translation.Form_Editors')</a></li>
						<li><a href="form-uploads" data-key="t-form-upload">@lang('translation.Form_File_Upload')</a></li>
						<li><a href="form-wizard" data-key="t-form-wizard">@lang('translation.Form_Wizard')</a></li>
						<li><a href="form-mask" data-key="t-form-mask">@lang('translation.Form_Mask')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="list"></i>
						<span class="menu-item" data-key="t-tables">@lang('translation.Tables')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="tables-basic" data-key="t-basic-tables">@lang('translation.Basic_Tables')</a></li>
						<li><a href="tables-advanced" data-key="t-advanced-tables">@lang('translation.Advanced_Table')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="pie-chart-outline"></i>
						<span class="menu-item" data-key="t-charts">@lang('translation.Charts')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="javascript: void(0);" class="has-arrow" data-key="t-apex-charts">@lang('translation.Apex_Charts')</a>
							<ul class="sub-menu" aria-expanded="true">
								<li><a href="charts-line" data-key="t-line">@lang('translation.Line')</a></li>
								<li><a href="charts-area" data-key="t-area">@lang('translation.Area')</a></li>
								<li><a href="charts-column" data-key="t-column">@lang('translation.Column')</a></li>
								<li><a href="charts-bar" data-key="t-bar">@lang('translation.Bar')</a></li>
								<li><a href="charts-mixed" data-key="t-mixed">@lang('translation.Mixed')</a></li>
								<li><a href="charts-timeline" data-key="t-timeline">@lang('translation.Timeline')</a></li>
								<li><a href="charts-candlestick" data-key="t-candlestick">@lang('translation.Candlestick')</a></li>
								<li><a href="charts-boxplot" data-key="t-boxplot">@lang('translation.Boxplot')</a></li>
								<li><a href="charts-bubble" data-key="t-bubble">@lang('translation.Bubble')</a></li>
								<li><a href="charts-scatter" data-key="t-scatter">@lang('translation.Scatter')</a></li>
								<li><a href="charts-heatmap" data-key="t-heatmap">@lang('translation.Heatmap')</a></li>
								<li><a href="charts-treemap" data-key="t-treemap">@lang('translation.Treemap')</a></li>
								<li><a href="charts-pie" data-key="t-pie">@lang('translation.Pie')</a></li>
								<li><a href="charts-radialbar" data-key="t-radialbar">@lang('translation.Radialbar')</a></li>
								<li><a href="charts-radar" data-key="t-radar">@lang('translation.Radar')</a></li>
								<li><a href="charts-polararea" data-key="t-polararea">@lang('translation.Polararea')</a></li>
							</ul>
						</li>
						<li><a href="charts-echart" data-key="t-e-charts">@lang('translation.E_Charts')</a></li>
						<li><a href="charts-chartjs" data-key="t-chartjs-charts">@lang('translation.Chartjs_Charts')</a></li>
						<li><a href="charts-tui" data-key="t-ui-charts">@lang('translation.Toast_UI_Charts')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="smiling-face-outline"></i>
						<span class="menu-item" data-key="t-icons">@lang('translation.Icons')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="icons-evaicons" data-key="t-evaicons">@lang('translation.Eva_Icons')</a></li>
						<li><a href="icons-boxicons" data-key="t-boxicons">@lang('translation.Boxicons')</a></li>
						<li><a href="icons-materialdesign" data-key="t-material-design">@lang('translation.Material_Design')</a></li>
						<li><a href="icons-fontawesome" data-key="t-font-awesome">@lang('translation.Font_awesome') 5</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="pin-outline"></i>
						<span class="menu-item" data-key="t-maps">@lang('translation.Maps')</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="maps-google" data-key="t-google">@lang('translation.Google')</a></li>
						<li><a href="maps-vector" data-key="t-vector">@lang('translation.Vector')</a></li>
						<li><a href="maps-leaflet" data-key="t-leaflet">@lang('translation.Leaflet')</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="icon nav-icon" data-eva="share-outline"></i>
						<span class="menu-item" data-key="t-multi-level">@lang('translation.Multi_Level')</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="javascript: void(0);" data-key="t-level-1.1">@lang('translation.Level_1.1')</a></li>
						<li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2">@lang('translation.Level_1.2')</a>
							<ul class="sub-menu" aria-expanded="true">
								<li><a href="javascript: void(0);" data-key="t-level-2.1">@lang('translation.Level_2.1')</a></li>
								<li><a href="javascript: void(0);" data-key="t-level-2.2">@lang('translation.Level_2.2')</a></li>
							</ul>
						</li>
					</ul>
				</li>

			</ul>
		</div>
		<!-- Sidebar -->

		<div class="p-3 px-4 sidebar-footer">
			<p class="mb-1 main-title">
				<script>
					document.write(new Date().getFullYear())
				</script> &copy; Borex.
			</p>
			<p class="mb-0">Design & Develop by Themesbrand</p>
		</div>
	</div>
</div>
<!-- Left Sidebar End -->
