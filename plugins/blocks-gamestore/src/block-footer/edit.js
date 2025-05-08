import {
	useBlockProps,
	InnerBlocks,
	InspectorControls, MediaPlaceholder
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, __experimentalDivider as Divider } from '@wordpress/components';
import './editor.scss';
 

  

// повторювальні елементи для посилань чи інші потрібно виносити за функцію edit
const LinkRepeater = ({ links, setLinks }) => {
	const addLink = () => setLinks([...links, { url: "", anchor: "" }]);

	const removeLink = (index) => setLinks(links.filter((_, i) => i !== index));

	const updateLink = (index, key, value) => {
		const updated = links.map((link, i) =>
			i === index ? { ...link, [key]: value } : link
		);
		setLinks(updated);
	};

	return (
		<div className="link-repeater">
			<h4>Manage Links</h4>
			{links.map((link, index) => (
				<div key={index} className="link-repeater-item">
					<TextControl
						label="URL"
						value={link.url || ""}
						onChange={(val) => updateLink(index, 'url', val)}
						placeholder="https://example.com"
					/>
					<TextControl
						label="Anchor Text"
						value={link.anchor || ""}
						onChange={(val) => updateLink(index, 'anchor', val)}
						placeholder="Link text"
					/>
					<Button variant="secondary" onClick={() => removeLink(index)} isDestructive>
						Remove Link
					</Button>
				</div>
			))}
			<Button variant="primary" onClick={addLink}>
				Add Link
			</Button>
		</div>
	);
};








// повторювальні елементи для посилань чи інші потрібно виносити за функцію edit
const LogoRepeater = ({ logos, setLogos }) => {
	const addLogo = () => setLogos([...logos, { url: "", image: "", imageDark: "" }]);

	const removeLogo = (index) => setLogos(logos.filter((_, i) => i !== index));

	const updateLogo = (index, key, value) => {
		const updatedLogos = logos.map((logo, i) =>
			i === index ? { ...logo, [key]: value } : logo
		);
		setLogos(updatedLogos);
	};

	return (
		<div className="logo-repeater">
			<h4>Manage Logos</h4>
			{logos.map((logo, index) => (
				<div key={index} className="logo-repeater-item">
					<TextControl
						label="URL"
						value={logo.url || ""}
						onChange={(val) => updateLogo(index, 'url', val)}
						placeholder="https://example.com"
					/>
                    
					{logo.image && (<img src={logo.image} alt="Logo" />)}


					<MediaPlaceholder 
						icon="format-image"
						labels={{ title: 'Logo Image' }}
						onSelect={(media) => updateLogo(index, 'image', media.url)}
						accept="image/*"
						allowedTypes={['image']}
					/><br/><br/>

						{logo.imageDark && (<img src={logo.imageDark} alt="Logo" />)}
					<MediaPlaceholder 
						icon="format-image"
						labels={{ title: 'Dark Variant Image' }}
						onSelect={(media) => updateLogo(index, 'imageDark', media.url)}
						accept="image/*"
						allowedTypes={['image']}
					/><br/><br/>


					
					<Button variant="secondary" onClick={() => removeLogo(index)} className="remove-logo-button" isDestructive>
						Remove Logo
					</Button>
				</div>
			))}
			<Button variant="primary" onClick={addLogo} className="add-logo-button">
				Add Logo
			</Button>
		</div>
	);
};





  

export default function Edit( { attributes, setAttributes } ) {
	const { copyrights, logos=[], links=[] } = attributes;

	const setLinks = (newLinks) => setAttributes({ links: newLinks });

	const setLogos = (newLogos) => setAttributes({ logos: newLogos });

	return (
		<>   
			<InspectorControls>
				<PanelBody title="Footer Link">
					<TextControl
						label="Copyrights"
						value={ copyrights }
						onChange={ ( copyrights ) =>
							setAttributes( { copyrights } )
						}
					/>
					<Divider margin={8} />
					<LinkRepeater links={links} setLinks={setLinks} />
					<Divider margin={8} />	
					<LogoRepeater logos={logos} setLogos={setLogos} />

				</PanelBody>
			</InspectorControls>  

			<div { ...useBlockProps() }>
				<div className= 'wrapper inner-footer'>
					<InnerBlocks />
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
				
		</>
	);
}
