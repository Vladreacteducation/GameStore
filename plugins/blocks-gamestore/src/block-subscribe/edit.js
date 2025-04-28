

import { useBlockProps,RichText, InspectorControls, MediaPlaceholder } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import{ __ } from '@wordpress/i18n';
import './editor.scss';



export default function Edit({attributes, setAttributes}) {
	const { shortcode, title, description, image } = attributes;
	return (
	<>
    <InspectorControls>
		<PanelBody title={ __( 'Settings', 'blocks-gamestore' ) }>
		
			<TextControl
				label={ __( 'Title', 'blocks-gamestore' ) }
				value={ title }
				onChange={ ( title ) => setAttributes( { title } ) }/>

			<TextareaControl	
				label={ __( 'Description', 'blocks-gamestore' ) }
				value={ description }
				onChange={ ( description ) => setAttributes( { description } ) }/>
{ image && (
	<img 
		src={ image} 
	/>
)}
			<MediaPlaceholder 
				icon="format-image"
				labels={ {
					title: __( 'Image', 'blocks-gamestore' ),
				}}
				onSelect={ ( media ) => {
					setAttributes( { image: media.url } );
				} }
				accept="image/*"
				allowedTypes={ [ 'image' ] }
				notices={ ['image'] }/>
               <br/> <br/>
				
			<TextareaControl	
				label={ __( 'Shortcode', 'blocks-gamestore' ) }
				value={ shortcode }
				onChange={ ( val ) => setAttributes( { shortcode:val } ) }/>

		</PanelBody>
	</InspectorControls>


	<div { ...useBlockProps({
		className:"alignfull",
		style: { backgroundImage: image ? `url(${image})` : undefined, }
	}) }>
		 <div className="subscribe-inner wrapper">
				<RichText
					tagName="h2"
					className="subscribe-title"
					value={title}
					onChange={(title) => setAttributes({ title })}
/>

				<RichText
					tagName="p"
					className="subscribe-description"
					value={description}
					onChange={(description) => setAttributes({ description })}
/>

		 </div>

		</div>
	</>
		
	);
} 
