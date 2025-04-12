import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';


export default function save({attributes}) {
	const { memberLink, cartLink } = attributes;

	return (
		<div {...useBlockProps.save()}> 
		 <div className="inner-header">
					<InnerBlocks.Content />
					<div className="right-section">
						<div className="header-search"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M22.29 21.66L17.61 16.95C20.97 13.2 20.7 7.44002 16.95 4.05002C13.2 0.660021 7.44002 0.960021 4.05002 4.71002C0.660021 8.46002 0.960021 14.22 4.71002 17.61C8.19002 20.76 13.5 20.76 16.98 17.61L21.69 22.32L22.29 21.66ZM10.83 19.05C6.30002 19.05 2.61002 15.36 2.61002 10.83C2.61002 6.27002 6.30002 2.61002 10.83 2.61002C15.36 2.61002 19.05 6.30002 19.05 10.83C19.05 15.36 15.36 19.05 10.83 19.05Z" fill="var(--action-main-svg,  rgb(255, 255, 255))" fill-opacity="0.64" />
  <path d="M10.8301 3.83984V4.73984C14.1901 4.73984 16.9201 7.46984 16.9201 10.8298H17.8201C17.8201 6.95984 14.7001 3.83984 10.8301 3.83984Z" fill="var(--action-main-svg,  rgb(255, 255, 255))" fill-opacity="0.64" />
</svg> 
</div>  
						<div className="header-mode-switcher"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M21 24V12" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M9 18H12" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M12.5098 9.51025L14.6398 11.6403" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M21 6V9" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M21 30V27" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M12.5098 26.4899L14.6398 24.3599" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M21 24C24.3137 24 27 21.3137 27 18C27 14.6863 24.3137 12 21 12C17.6863 12 15 14.6863 15 18C15 21.3137 17.6863 24 21 24Z" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
</svg></div>


						{ cartLink && (
							<div className="header-cart-link">
								<a href={ cartLink }>
									<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M7.71436 14.5718L9.42864 26.5718H26.5715L28.2858 14.5718" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M12.8569 16.2859L14.5712 9.42871" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M23.143 16.2859L21.4287 9.42871" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
  <path d="M6 14.5718H30" stroke="var(--action-main-svg,  rgb(255, 255, 255))" stroke-opacity="0.64" stroke-linecap="round" stroke-linejoin="round" />
</svg>
</a>
							</div>
						) }
						{ memberLink && (
							<div className="header-member-link">
								<a href={ memberLink }>Member Area</a>
							</div>
						) }
					</div>
				</div>
		</div>
	);
}
