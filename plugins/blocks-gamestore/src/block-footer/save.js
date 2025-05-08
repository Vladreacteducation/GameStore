import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';


export default function save({attributes}) {
	const { copyrights, logos=[], links=[]  } = attributes;

	return (
		<div {...useBlockProps.save()}> 
		<div className= 'wrapper inner-footer'>
					<InnerBlocks.Content/>
					<div className="footer-line"></div>

						<div className='footer-buttom'>
							<div className='left-part'>
								{copyrights &&(<p className='copyrights'>{ copyrights }</p>)} 

								{logos && (
								<div className="footer-logos">
									{logos.map((logo, index) => (
												<a
												key={index}
												href={logo.url}
												target="_blank"
												rel="nofollow noreferrer"
												className="footer-logo"
											>
												{logo.image && <img src={logo.image} class="light-logo" alt="Logo" />}
		
												{logo.imageDark && <img src={logo.imageDark} class="dark-logo" alt="Logo" />}
											</a>
									))}
								</div>
								)}

							</div>

							<div className='right-part'>

								
							{links 	&& links.map((link, index) => (
								<a key={index}
									href={link.url}
									className="footer-link"
								>{link.anchor}</a>
							))}
								</div>
				</div>
				</div>
		</div>
	);
}
