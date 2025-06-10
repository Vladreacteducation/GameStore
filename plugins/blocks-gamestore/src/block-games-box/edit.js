import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
  const { count, title } = attributes;

	return (
    <>
    <InspectorControls>
      <PanelBody title={ __( 'Settings', 'blocks-gamestore' ) }>
        <TextControl
          label={ __( 'Count', 'blocks-gamestore' ) }
          value={ count }
          onChange={ ( val ) => setAttributes( { count: parseInt(val, 10) || 0 } ) }
        />
        <TextControl
          label={ __( 'Title', 'blocks-gamestore' ) }
          value={ title }
          onChange={ ( title ) => setAttributes( { title } ) }
        />
      </PanelBody>
    </InspectorControls>
    <div { ...useBlockProps() }>
      Games Box Filter
		</div>
    </>
		
	);
}
