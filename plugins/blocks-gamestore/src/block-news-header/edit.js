import { useBlockProps, InspectorControls, MediaPlaceholder, RichText } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, image } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'blocks-gamestore')}>
					<TextControl
						label={__('Title', 'blocks-gamestore')}
						value={title}
						onChange={(title) => setAttributes({ title })}
					/>
					<TextareaControl
						label={__('Description', 'blocks-gamestore')}
						value={description}
						onChange={(description) => setAttributes({ description })}
					/>
					{image && (
						<img
							src={image}
							alt={__('Selected image', 'blocks-gamestore')}
							style={{ maxWidth: '100%', height: 'auto' }}
						/>
					)}
					<MediaPlaceholder
						icon="format-image"
						labels={{
							title: __('Image', 'blocks-gamestore'),
						}}
						onSelect={(media) => {
							setAttributes({ image: media.url });
						}}
						accept="image/*"
						allowedTypes={['image']}
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps({
		className:"alignfull",
		style: { backgroundImage: image ? `url(${image})` : undefined, }
	}) }>
				<div className="wrapper">
					<RichText
						tagName="h1"
						className="new-header-title"
						value={title}
						onChange={(title) => setAttributes({ title })}
						placeholder="Add a title for the hero section"
					/>


							<RichText
						tagName="p"
						className="new-header-description"
						value={description}
						onChange={(description) => setAttributes({ description })}
						placeholder="Add a title for the hero section"
					/>
				</div>
			</div>
		</>
	);
}
