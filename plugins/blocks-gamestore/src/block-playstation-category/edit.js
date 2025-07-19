import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { title, description, backgroundImage } = attributes;

	const onSelectImage = (media) => {
		setAttributes({ backgroundImage: media.url });
	};

	const onRemoveImage = () => {
		setAttributes({ backgroundImage: '' });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Block Settings', 'gamestore')} initialOpen={true}>
					<TextControl
						label={__('Title', 'gamestore')}
						value={title}
						onChange={(val) => setAttributes({ title: val })}
					/>
					<TextareaControl
						label={__('Description', 'gamestore')}
						value={description}
						onChange={(val) => setAttributes({ description: val })}
					/>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectImage}
							allowedTypes={['image']}
							render={({ open }) => (
								<div style={{ marginTop: '1rem' }}>
									<Button onClick={open} variant="primary">
										{backgroundImage ? __('Change Background', 'gamestore') : __('Select Background', 'gamestore')}
									</Button>
									{backgroundImage && (
										<Button onClick={onRemoveImage} variant="secondary" style={{ marginLeft: '10px' }}>
											{__('Remove', 'gamestore')}
										</Button>
									)}
								</div>
							)}
						/>
					</MediaUploadCheck>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps() }>
			  <ServerSideRender
				block="blocks-gamestore/block-playstation-category"
				attributes={attributes}
			  />
				</div>
		</>
	);
}
