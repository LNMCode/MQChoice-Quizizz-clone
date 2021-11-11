import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_event.dart';
import 'package:mobileapplication/screens/roomques/blocs/getroom/getroom_state.dart';

class RoomQuesScreen extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _RoomQuesScreenState();
}

class _RoomQuesScreenState extends State<RoomQuesScreen> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('This is title of appBar'),
      ),
      body: Center(
        child: BlocConsumer<GetRoomBloc, GetRoomState>(
          listener: (context, state) {},
          builder: (context, state) {
            if (state is GetRoomStateLoading) {
              return Center(child: CircularProgressIndicator());
            }
            if (state is GetRoomStateSuccess) {
              final roomReponse = state.room_response;
              final room = roomReponse.doc;
              return Center(
                child: Text(room.idroom),
              );
            }
            if (state is GetRoomStateFail) {
              return Text('Something went wrong');
            }
            return Center(
                child: TextButton(
              onPressed: () {
                BlocProvider.of<GetRoomBloc>(context)
                    .add(GetRoomEventRequested('id123456'));
              },
              child: Text('TextButton'),
            ));
          },
        ),
      ),
    );
  }
}
